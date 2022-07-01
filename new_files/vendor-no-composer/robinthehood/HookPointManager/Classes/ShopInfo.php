<?php

namespace RobinTheHood\HookPointManager\Classes;

use RuntimeException;

class ShopInfo
{
    /**
     * Returns the path of the shop root directory
     *
     * Notice: __DIR__ and __FILE__ can not handle symlinks. Both magic constants paths are resolved.
     * That's why we have to test both cases.
     */
    public static function getShopRoot(): string
    {
        $fileThatMustExist = '/admin/includes/version.php';

        // Check if file is installed as copy
        // .../SHOP-ROOT/vendor-no-composer/robinthehood/HookPointManager/Classes/"
        $path = realPath(__DIR__ . '/../../../../');
        $testPath = $path . $fileThatMustExist;
        if (\file_exists($testPath)) {
            return $path;
        }

        // Check if file is installed as copy + version path
        // .../SHOP-ROOT/vendor-no-composer/robinthehood/HookPointManager/VERSION/Classes/"
        $path = realPath(__DIR__ . '/../../../../../');
        $testPath = $path . $fileThatMustExist;
        if (\file_exists($testPath)) {
            return $path;
        }

        // Check if file is installed as symlink
        // .../SHOP-ROOT/ModifiedModuleLoaderClient/Modules/robinthehood/hook-point-manager/new_files/vendor-no-composer/robinthehood/HookPointManager/Classes/"
        $path = realPath(__DIR__ . '/../../../../../../../../../');
        $testPath = $path . $fileThatMustExist;
        if (\file_exists($testPath)) {
            return $path;
        }

        // Check if file is installed as symlink + version path
        // .../SHOP-ROOT/ModifiedModuleLoaderClient/Modules/robinthehood/hook-point-manager\VERSION\new_files/vendor-no-composer/robinthehood/HookPointManager/Classes/"
        $path = realPath(__DIR__ . '/../../../../../../../../../../');
        $testPath = $path . $fileThatMustExist;
        if (\file_exists($testPath)) {
            return $path;
        }

        throw new RuntimeException('Can not find and resolve ShopRoot');
    }

    /**
     * @return string Returns the installed modified version as string.
     */
    public static function getModifiedVersion(): string
    {
        $path = self::getShopRoot() . '/admin/includes/version.php';
        if (!file_exists($path)) {
            return '';
        }

        $fileStr = file_get_contents($path);
        $pos = strpos($fileStr, 'MOD_');
        $version = substr($fileStr, (int) $pos + 4, 7);
        return $version;
    }
}
