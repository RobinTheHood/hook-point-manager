<?php

namespace RobinTheHood\HookPointManager\Classes\DefaultHookPoints;

use RobinTheHood\HookPointManager\Classes\HookPointManager;

/*
    *** Default Hook Points for Modified 2.0.3.0 ***
    You can add new hook points by making a pull request in https://github.com/RobinTheHood/hook-point-manager

    index   | description                                           | example value
    --------------------------------------------------------------------------------------------------
    name    | unique name of the hook point                         | hpm-default-create-account-prepare-data
    module  | module name of hook point creator                     | robinthehood/hook-point-manager
    file    | file path in which the hook point is to be installed  | /create_account.php
    hash    | md5-Hash of original unmodified file                  | 2b5ce65ba6177ed24c805609b28572a7
    line    | line after which the hook point is to be installed    | 289
    include | auto_include directory for the hook point files       | /includes/extra/hpm/create_account/prepare_data/
 */

class DefaultHookPointsFor2030
{
    public function registerAll()
    {
        $modifiedVersions = ['2.0.3.0'];

        $hookPointManager = new HookPointManager();

        $hookPointManager->registerHookPoint([
            'name' => 'hpm-default-define-conditions-top',
            'module' => 'robinthehood/hook-point-manager',
            'file' => '/includes/define_conditions.php',
            'hash' => 'bccc833a5ccea4d1af321733a0317007',
            'line' => 12,
            'include' => '/includes/extra/hpm/define-conditions/top/'
        ], $modifiedVersions);
    }

    public function unregisterAll()
    {
        $hookPointManager = new HookPointManager();
        $hookPointManager->unregisterHookPoint('hpm-default-define-conditions-top');
    }
}
