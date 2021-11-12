<?php

namespace RobinTheHood\HookPointManager\Classes\DefaultHookPoints;

use RobinTheHood\HookPointManager\Classes\HookPointManager;

/*
    *** Default Hook Points for Modified 2.0.6.0 ***
    You can add new hook points by making a pull request in https://github.com/RobinTheHood/hook-point-manager

    index   | description                                           | example value
    --------------------------------------------------------------------------------------------------
    name    | unique name of the hook point                         | hpm-default-create-account-prepare-data
    module  | module name of hook poit creator                      | robinthehood/hook-point-manager
    file    | file path in which the hook point is to be installed  | /create_account.php
    hash    | md5-Hash of original unmodified file                  | 2b5ce65ba6177ed24c805609b28572a7
    line    | line after which the hook point is to be installed    | 289
    include | auto_include directory for the hook point files       | /includes/extra/hpm/create_account/prepare_data/
 */

class DefaultHookPointsFor2060
{
    public function registerAll()
    {
        $modifiedVersions = ['2.0.6.0'];

        $hookPointManager = new HookPointManager();

        $hookPointManager->registerHookPoint([
            'name' => 'hpm-default-autocomplete-prepare-sql',
            'module' => 'robinthehood/hook-point-manager',
            'file' => '/api/autocomplete/autocomplete.php',
            'hash' => 'ae82ab388defe37a76e1ffc1658f3d3f',
            'line' => 78,
            'include' => '/includes/extra/hpm/api/autocomplete/prepare_sql/'
        ], $modifiedVersions);
    }
}
