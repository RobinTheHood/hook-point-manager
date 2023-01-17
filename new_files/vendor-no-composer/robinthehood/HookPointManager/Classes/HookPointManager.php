<?php

namespace RobinTheHood\HookPointManager\Classes;

class HookPointManager
{
    protected $errors = [];

    public function __construct()
    {
        $hookPointRepository = new HookPointRepository();
        $hookPointRepository->createTableRthHookPointIfNotExists();
    }

    /**
     * @param array $hookPoint
     * @param string[] $versions
     */
    public function registerHookPoint(array $hookPoint, array $versions): void
    {
        $hookPointRepository = new HookPointRepository();

        foreach ($versions as $version) {
            $hookPoint['version'] = $version;

            if ($hookPointRepository->getHookPointByNameAndVersion($hookPoint['name'], $hookPoint['version'])) {
                $hookPointRepository->updateHookPoint($hookPoint);
            } else {
                $hookPointRepository->addHookPoint($hookPoint);
            }
        }
    }

    /**
     * @param string $hookPointName
     */
    public function unregisterHookPoint(string $hookPointName): void
    {
        $hookPointRepository = new HookPointRepository();
        $hookPointRepository->deleteHookPointByName($hookPointName);
    }

    public function registerDefault(): void
    {
        (new DefaultHookPoints\DefaultHookPointsFor2030())->registerAll();
        (new DefaultHookPoints\DefaultHookPointsFor2051())->registerAll();
        (new DefaultHookPoints\DefaultHookPointsFor2060())->registerAll();
        (new DefaultHookPoints\DefaultHookPointsFor2070())->registerAll();
        (new DefaultHookPoints\DefaultHookPointsFor2071())->registerAll();
        (new DefaultHookPoints\DefaultHookPointsFor2072())->registerAll();
    }

    public function unregisterDefault(): void
    {
        (new DefaultHookPoints\DefaultHookPointsFor2030())->unregisterAll();
        (new DefaultHookPoints\DefaultHookPointsFor2051())->unregisterAll();
        (new DefaultHookPoints\DefaultHookPointsFor2060())->unregisterAll();
        (new DefaultHookPoints\DefaultHookPointsFor2070())->unregisterAll();
        (new DefaultHookPoints\DefaultHookPointsFor2071())->unregisterAll();
        (new DefaultHookPoints\DefaultHookPointsFor2072())->unregisterAll();
    }

    /**
     * Installs or updates all in database registered HookPoints to files. Only registered
     * HookPoints will be installed, so you have to register a HookPoint to database first.
     */
    public function update(): void
    {
        $modifiedVersion = ShopInfo::getModifiedVersion();
        $hookPointRepository = new HookPointRepository();
        $hookPoints = $hookPointRepository->getAllHookPointsByVersion($modifiedVersion);

        $this->updateHookPoints($hookPoints);
    }

    /**
     * Removes all registered HookPoints from all files. Does not delete HookPoints database entries,
     * so you can reinstall all HookPoints via update().
     */
    public function remove(): void
    {
        $hookPointRepository = new HookPointRepository();
        $hookPoints = $hookPointRepository->getAllHookPoints();

        $groupedHookPoints = $this->groupHookPointsByFile($hookPoints);

        foreach ($groupedHookPoints as $fileHookPoints) {
            $relativeFilePath = $fileHookPoints[0]['file'];
            $this->removeAllHookPointsFromFile($relativeFilePath);
        }
    }

    public function updateHookPoints(array $hookPoints): void
    {
        $groupedHookPoints = $this->groupHookPointsByFile($hookPoints);

        foreach ($groupedHookPoints as $fileHookPoints) {
            $relativeFilePath = $fileHookPoints[0]['file'];
            $hash = $fileHookPoints[0]['hash'];
            $this->createBackupFile($relativeFilePath, $hash);
            $this->insertHookPointsToFile($relativeFilePath, $fileHookPoints);
        }
    }

    public function groupHookPointsByFile(array $hookPoints): array
    {
        $groupedHookPoints = [];
        foreach ($hookPoints as $hookPoint) {
            $relativeFilePath = $hookPoint['file'];
            $groupedHookPoints[$relativeFilePath][] = $hookPoint;
        }
        return $groupedHookPoints;
    }

    //TODO: only copy when file-hash is equal
    public function createBackupFile(string $relativeFilePath, string $hash): void
    {
        $filePath = ShopInfo::getShopRoot() . $relativeFilePath;
        $orgFilePath = str_replace('.php', '.hpmorg.php', $filePath);

        if (!file_exists($filePath)) {
            // throw new \RuntimeException("Can not create original file $orgFilePath because $filePath not exsits.");
            $this->addError("Can not create original file $orgFilePath because $filePath not exsits.");
            return;
        }

        if (file_exists($orgFilePath)) {
            return;
        }

        if (md5(file_get_contents($filePath)) != $hash) {
            // throw new \RuntimeException("Can not create original file $orgFilePath out of $filePath because file hash dose not match.");
            $this->addError("Can not create original file $orgFilePath out of $filePath because file hash dose not match.");
            return;
        }

        copy($filePath, $orgFilePath);
    }

    /**
     * Insert a list of HookPoints to a file. The base file is always the original file. This method
     * does not append a HookPoint to a file with already added HookPoints. In the end you can only find
     * the HookPoints from $fileHookPoints in the result file.
     */
    public function insertHookPointsToFile(string $relativeFilePath, array $fileHookPoints): void
    {
        $filePath = ShopInfo::getShopRoot() . $relativeFilePath;
        $orgFilePath = str_replace('.php', '.hpmorg.php', $filePath);

        if (!file_exists($orgFilePath)) {
            //throw new \RuntimeException("Can not create hook points in $filePath because $orgFilePath not exsits.");
            $this->addError("Can not create hook points in $filePath because $orgFilePath not exsits.");
            return;
        }

        // Test hashes
        $hash = md5(file_get_contents($orgFilePath));
        foreach ($fileHookPoints as $hookPoint) {
            if ($hookPoint['hash'] != $hash) {
                $hookPointName = $hookPoint['name'];
                // throw new \RuntimeException("Can install $hookPointName in $filePath because file hash dose not match.");
                $this->addError("Can install $hookPointName in $filePath because file hash dose not match with original file.");
                return;
            }
        }

        $fileContent = file_get_contents($orgFilePath);
        $lines = explode("\n", $fileContent);

        foreach ($fileHookPoints as $hookPoint) {
            $name = $hookPoint['name'] ?? 'unknown-hook-point-name';
            $line = $hookPoint['line'];
            $indexName = $line . ':' . $name;
            $autoIncludeCode = $this->createAutoIncludeCode($hookPoint, $orgFilePath);
            $lines = ArrayHelper::insertAfter($lines, $line - 1, $indexName, $autoIncludeCode);
        }

        $newFileContent = implode("\n", $lines);

        file_put_contents($filePath, $newFileContent);
    }

    public function removeAllHookPointsFromFile(string $relativeFilePath): void
    {
        $emptyHookPointList = [];
        $this->insertHookPointsToFile($relativeFilePath, $emptyHookPointList);
    }

    public function createAutoIncludeCode(array $hookPoint, string $orgFilePath): string
    {
        $name = $hookPoint['name'] ?? 'unknown-hook-point-name';
        $module = $hookPoint['module'] ?? 'unknown-hook-point-module';
        $includePath = $hookPoint['include'] ?? '/includes/etxra/hpm/unknown_hook_point/';

        $code = "/* *** robinthehood/hook-point-manager START ***" . "\n";
        $code .= " * This is a automatically generated file with new hook points." . "\n";
        $code .= " * You can find the original unmodified file at: $orgFilePath" . "\n";
        $code .= " *" . "\n";
        $code .= " * From Module: $module" . "\n";
        $code .= " * HookPointName: $name" . "\n";
        $code .= " */" . "\n";
        $code .= "foreach(auto_include(DIR_FS_CATALOG . '$includePath','php') as \$file) require (\$file);" . "\n";
        $code .= "/* robinthehood/hook-point-manager END */" . "\n";
        return $code;
    }

    public function addError(string $error): void
    {
        $this->errors[] = $error;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
