<?php
namespace RobinTheHood\HookPointManager\Classes;

class HookPointRepository
{
    public function addHookPoint(array $hookPoint): void
    {
        $version = $hookPoint['version'];
        $module = $hookPoint['module'];
        $name = $hookPoint['name'];
        $include = $hookPoint['include'];
        $file = $hookPoint['file'];
        $line = $hookPoint['line'];
        $description = $hookPoint['description'];


        $sql = "INSERT INTO rth_hook_point
            (`version`, `module`, `name`, `include`, `file`, `line`, `description`)
            VALUES
            ('$version', '$module', '$name', '$include', '$file', '$line', '$description');";

        $query = xtc_db_query($sql);
    }

    public function getHookPointByNameAndVersion(string $name, string $version): ?array
    {
        $sql = "SELECT * FROM rth_hook_point WHERE name='$name' AND version='$version';";
        $query = xtc_db_query($sql);

        $row = xtc_db_fetch_array($query);
        return $row;
    }

    public function getAllHookPointsByVersion(string $version): array
    {
        $sql = "SELECT * FROM rth_hook_point WHERE version='$version';";
        $query = xtc_db_query($sql);

        $hookPoints = [];
        while ($row = xtc_db_fetch_array($query)) {
            $hookPoints[] = $row;
        }
        return $hookPoints;
    }
}