<?php

namespace RobinTheHood\HookPointManager\Classes\DefaultHookPoints;

use RobinTheHood\HookPointManager\Classes\HookPointManager;

/*
    *** Default Hook Points for Modified 2.0.7.1 ***
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

class DefaultHookPointsFor2071
{
    public function registerAll(): void
    {
        $modifiedVersions = ['2.0.7.1'];

        $hookPointManager = new HookPointManager();

        /**
         * /create_account.php
         */

        $hookPointManager->registerHookPoint([
            'name' => 'hpm-default-create-account-prepare-data',
            'module' => 'robinthehood/hook-point-manager',
            'file' => '/create_account.php',
            'hash' => '16ef2e7c40001222d3054c876e28dba2',
            'line' => 280,
            'include' => '/includes/extra/hpm/create_account/prepare_data/'
        ], $modifiedVersions);

        /**
         * /create_guest_account.php
         */

        $hookPointManager->registerHookPoint([
            'name' => 'hpm-default-create-guest-account-prepare-data',
            'module' => 'robinthehood/hook-point-manager',
            'file' => '/create_guest_account.php',
            'hash' => 'eea031e80a28102387e6604720c64185',
            'line' => 242,
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
            'line' => 664,
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
            'hash' => 'c0464372ec54c35c060b0d5784551007',
            'line' => 258,
            'include' => '/admin/includes/extra/hpm/new_product/buttons/'
        ], $modifiedVersions);

        /**
         * /api/autocomplete/autocomplete.php
         */
        $hookPointManager->registerHookPoint([
            'name' => 'hpm-default-autocomplete-prepare-sql',
            'module' => 'robinthehood/hook-point-manager',
            'file' => '/api/autocomplete/autocomplete.php',
            'hash' => '850d2e0e8afde3c5063781f0eef6b2cb',
            'line' => 79,
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

    public function unregisterAll(): void
    {
        $hookPointManager = new HookPointManager();
        $hookPointManager->unregisterHookPoint('hpm-default-create-account-prepare-data');
        $hookPointManager->unregisterHookPoint('hpm-default-create-guest-account-prepare-data');
        $hookPointManager->unregisterHookPoint('hpm-default-admin-categories-view-small-buttons');
        $hookPointManager->unregisterHookPoint('hpm-default-admin-categories-view-side-buttons');
        $hookPointManager->unregisterHookPoint('hpm-default-admin-new-product-buttons');
        $hookPointManager->unregisterHookPoint('hpm-default-autocomplete-prepare-sql');
        $hookPointManager->unregisterHookPoint('hpm-default-define-conditions-top');
    }
}
