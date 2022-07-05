<?php

namespace RobinTheHood\HookPointManager\Classes;

class HookPointRepository
{
    public function createTableRthHookPointIfNotExists(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS `rth_hook_point` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `version` varchar(255) DEFAULT NULL,
            `module` varchar(255) DEFAULT NULL,
            `name` varchar(255) DEFAULT NULL,
            `include` text,
            `file` text,
            `hash` varchar(255) DEFAULT NULL,
            `line` int(11) DEFAULT NULL,
            `description` text,
            PRIMARY KEY (`id`)
          ) DEFAULT CHARSET=utf8;";
        $query = xtc_db_query($sql);
    }

    public function addHookPoint(array $hookPoint): void
    {
        $version = $hookPoint['version'] ?? '';
        $module = $hookPoint['module'] ?? '';
        $name = $hookPoint['name'] ?? '';
        $include = $hookPoint['include'] ?? '';
        $file = $hookPoint['file'] ?? '';
        $hash = $hookPoint['hash'] ?? '';
        $line = $hookPoint['line'] ?? '';
        $description = $hookPoint['description'] ?? '';


        $sql = "INSERT INTO rth_hook_point
            (`version`, `module`, `name`, `include`, `file`, `hash`, `line`, `description`)
            VALUES
            ('$version', '$module', '$name', '$include', '$file', '$hash', '$line', '$description');";

        $query = xtc_db_query($sql);
    }

    public function updateHookPoint(array $hookPoint): void
    {
        $version = $hookPoint['version'] ?? '';
        $module = $hookPoint['module'] ?? '';
        $name = $hookPoint['name'] ?? '';
        $include = $hookPoint['include'] ?? '';
        $file = $hookPoint['file'] ?? '';
        $hash = $hookPoint['hash'] ?? '';
        $line = $hookPoint['line'] ?? '';
        $description = $hookPoint['description'] ?? '';


        $sql = "UPDATE rth_hook_point SET
                    `version` = '$version',
                    `module` = '$module',
                    `name` = '$name',
                    `include` = '$include',
                    `file` = '$file',
                    `hash` = '$hash',
                    `line` = '$line',
                    `description` = '$description'
                WHERE `version` = '$version' AND `name` = '$name';";

        //die($sql);
        $query = xtc_db_query($sql);
    }

    public function getAllHookPoints(): array
    {
        $sql = "SELECT * FROM rth_hook_point";
        $query = xtc_db_query($sql);

        $hookPoints = [];
        while ($row = xtc_db_fetch_array($query)) {
            $hookPoints[] = $row;
        }
        return $hookPoints;
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

    public function deleteHookPointByName(string $name): void
    {
        $sql = "DELETE FROM WHERE name='$name'";
        $query = xtc_db_query($sql);
    }
}
