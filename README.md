# hook-point-manager
[![dicord](https://img.shields.io/discord/727190419158597683)](https://discord.gg/9NqwJqP)

Automatically creates and manages new hook points for modified shops.

## About
With this module, developers can easily create and manage new hook points for the auto_include system of *modified eCommerce shops*. With the help of this module, all modules can be developed to be updateable.

## Installation
You can install this module with the [Modified Module Loader Client (MMLC)](http://module-loader.de).

Search for: `robinthehood/hook-point-manager`

## How to use

### Default Hook Points (recommended)
This example shows you how to add all default hook points to modifieds core files. It's always better to look for a default hook point and use a default one or make a pull request to add a new default hook point:

```php
use RobinTheHood\HookPointManager\Classes\HookPointManager;

$hookPointManager = new HookPointManager();
$hookPointManager->registerDefault();
$hookPointManager->update();
```

After that you can use all default hook points.

#### Add a new default hook point
If you need a new default hook point, you can add one. First check whether there is already a default hook point that fits you needs. To add a new default hook point go to the directory */new_files/vendor-no-composer/robinthehood/HookPointManager/Classes/DefaultHookPoints/* and add your new hook point there. After that you have to make a pull request, so that every user and developer can use your new hook point. 

### Create your own very special Hook Point (not recommended)
If you need a very special hook point, you can create your own without a Pull Request. For example: because no one wants your new default pull request hook point and your pull request is refused 😢🥺. This hook point is only usable for you, your projects and your module. This is **not recommended** if you can avoid it with a default hook point. You can find default hook points in */new_files/vendor-no-composer/robinthehood/HookPointManager/Classes/DefaultHookPoints/* or add a new default hook point with a pull request. If you still need your very super special hook point you can use the following code:

```php
$hookPointManager = new HookPointManager();

$hookPointManager->registerHookPoint([
    'name' => 'mc-my-hook-point-name',
    'module' => 'my-company/my-first-module',
    'file' => '/create_account.php',
    'hash' => '2b5ce65ba6177ed24c805609b28572a7',
    'line' => 30,
    'include' => '/includes/extra/my-company/my-first-module/create_account/'
], ['2.0.4.1', '2.0.4.2', '2.0.5.1']);
```

## Reference

### array $hookPoint
| index   | description                                          | example value                       |
|---------|------------------------------------------------------|-------------------------------------|
| name    | unique name of the hook point                        | mc-my-hook-point-name               |
| module  | module name of hook point creator                     | my-company/my-first-module          |
| file    | file path in which the hook point is to be installed | /create_account.php                 |
| hash    | md5-Hash of original unmodified file                 | 2b5ce65ba6177ed24c805609b28572a7    |
| line    | line after which the hook point is to be installed   | 30                                  |
| include | auto_include directory for the hook point files      | /includes/extra/.../create_account/ |

### HookPointManager::registerHookPoint(array $hookPoint, array $versions)

## TODO
- [ ] New Methods to restore all original core files or/and unregister a or all hook-points. (I think it's not that hard to program it)
