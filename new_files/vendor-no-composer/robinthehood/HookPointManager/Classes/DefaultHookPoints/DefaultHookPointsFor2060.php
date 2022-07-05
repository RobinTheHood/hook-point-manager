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

        /**
         * /create_account.php
         */

        $hookPointManager->registerHookPoint([
            'name' => 'hpm-default-create-account-prepare-data',
            'module' => 'robinthehood/hook-point-manager',
            'file' => '/create_account.php',
            'hash' => 'd9221348e6076d94b8153ab91814ab6e',
            'line' => 296,
            'include' => '/includes/extra/hpm/create_account/prepare_data/'
        ], $modifiedVersions);

        /**
         * /create_guest_account.php
         */

        $hookPointManager->registerHookPoint([
            'name' => 'hpm-default-create-guest-account-prepare-data',
            'module' => 'robinthehood/hook-point-manager',
            'file' => '/create_guest_account.php',
            'hash' => '1b83edb80bb28522f17bdb9715dd9d2c',
            'line' => 260,
            'include' => '/includes/extra/hpm/create_guest_account/prepare_data/'
        ], $modifiedVersions);

        /**
         * /admin/includes/modules/categories_view.php
         */

        $hookPointManager->registerHookPoint([
            'name' => 'hpm-default-admin-categories-view-small-buttons',
            'module' => 'robinthehood/hook-point-manager',
            'file' => '/admin/includes/modules/categories_view.php',
            'hash' => '95df9da9d04d4d59bac9712d7ed0c920',
            'line' => 665,
            'include' => '/admin/includes/extra/hpm/categories_view/small_buttons/'
        ], $modifiedVersions);


        $hookPointManager->registerHookPoint([
            'name' => 'hpm-default-admin-categories-view-side-buttons',
            'module' => 'robinthehood/hook-point-manager',
            'file' => '/admin/includes/modules/categories_view.php',
            'hash' => '95df9da9d04d4d59bac9712d7ed0c920',
            'line' => 1021,
            'include' => '/admin/includes/extra/hpm/categories_view/side_buttons/'
        ], $modifiedVersions);

        /**
         * /admin/includes/modules/new_product.php
         */

        $hookPointManager->registerHookPoint([
            'name' => 'hpm-default-admin-new-product-buttons',
            'module' => 'robinthehood/hook-point-manager',
            'file' => '/admin/includes/modules/new_product.php',
            'hash' => 'f5bce50f35a1c99224b32cc64fbbfa3f',
            'line' => 259,
            'include' => '/admin/includes/extra/hpm/new_product/buttons/'
        ], $modifiedVersions);

        /**
         * /api/autocomplete/autocomplete.php
         */
        $hookPointManager->registerHookPoint([
            'name' => 'hpm-default-autocomplete-prepare-sql',
            'module' => 'robinthehood/hook-point-manager',
            'file' => '/api/autocomplete/autocomplete.php',
            'hash' => 'ae82ab388defe37a76e1ffc1658f3d3f',
            'line' => 78,
            'include' => '/includes/extra/hpm/api/autocomplete/prepare_sql/'
        ], $modifiedVersions);

        /**
         * /includes/define_conditions.php
         */
        $hookPointManager->registerHookPoint([
            'name' => 'hpm-default-define-conditions-top',
            'module' => 'robinthehood/hook-point-manager',
            'file' => '/includes/define_conditions.php',
            'hash' => 'ebe43f505e41720c0ccbc5ad27a6eac9',
            'line' => 12,
            'include' => '/includes/extra/hpm/define-conditions/top/'
        ], $modifiedVersions);
    }
}
