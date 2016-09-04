# RbacUserDoctrineOrm
ZF Module which in integrate [ZfcUserDoctrineOrm](https://github.com/ZF-Commons/ZfcUserDoctrineORM) with [ZfcRbac](https://github.com/ZF-Commons/zfc-rbac).
Inspired by https://github.com/esserj/RbacUserDoctrineOrm

Dependencies
------------

- PHP >= 5.6
- Zend Framework 3 or >= 2.7
- [ZfcUser](https://github.com/ZF-Commons/ZfcUser)
- [ZfcUserDoctrineOrm](https://github.com/ZF-Commons/ZfcUserDoctrineORM)
- [DoctrineModule](https://github.com/doctrine/DoctrineModule)
- [DoctrineORMModule](https://github.com/doctrine/DoctrineORMModule)
- [ZfcRbac](https://github.com/ZF-Commons/zfc-rbac)

Installation
------------

Install RbacUserDoctrineOrm Module using composer

    {
        ...,
        "require": {
            ...,
            "evilband7/rbac-user-doctrine-orm" : "~0.1 || dev-master"
        }
    }

ps. If you using **ZF2**, please add **zf-commons/zfc-user-doctrine-orm** into your composer dependency. For **ZF3**, please install **ZfcUserDoctrineOrm** manually by cloning module into your project.

for ZF3 project, your composer should look like this.

    {
        ...,
        "require": {
            ...,
            "zendframework/zend-mvc" : "~3.0",
            "zendframework/zend-servicemanager" : "~3.0",
            "zendframework/zend-eventmanager" : "~3.0",
            "zendframework/zend-router" : "~3.0",
            "zf-commons/zfc-rbac" : "~2.5 || dev-master",
            "zf-commons/zfc-user" : "~2.0 || 2.x-dev",
            "doctrine/doctrine-module" : "~1.0 || dev-master",
            "doctrine/doctrine-orm-module" : "~1.0 || dev-master",
            "evilband7/rbac-user-doctrine-orm" : "~0.1 || dev-master"
        }
    }


Then set up your Modules in `config/application/application.config.php`, something like

    'modules' => array(
        'DoctrineModule',
        'DoctrineORMModule',
        'ZfcBase',
        'ZfcUser',
        'ZfcUserDoctrineORM',
        'RbacUserDoctrineOrm',
        'Application',
    ),


Now, you can use `doctrine-module` to to set up your database tables (config your connection first [Doctrine Connection Settings](https://github.com/doctrine/DoctrineORMModule#connection-settings)).

    vendor/bin/doctrine-module orm:schema-tool:update --dump-sql

If SQL looks okay, do: 

    vendor/bin/doctrine-module orm:schema-tool:update --force

# Roles
RbacUserDoctrineOrm provide 2 sources of roles.

1. `dbRoles` field which is hierarchy roles. You can define dbRoles in database tables `( auth_user, auth_role, auth_permission, auth_users_roles and auth_roles_permissions )`

2. `providerRoles` field which is comma separated in `auth_user.provider_roles` column. Roles from this source will not work unless you provide your own [RoleProvder](https://github.com/ZF-Commons/zfc-rbac/blob/master/docs/03.%20Role%20providers.md)

# Customize User Entity
Fist, copy config/rbac-user-doctrine.global.php.dist to autoload folder. (don't forget to remove .dist)
Then customize your entity class name

     return [
          'rbac-user-doctrine-orm' => [
              'enable_default_user_entity' => false,
          ],
          'zfcuser' => [
              'userEntityClass' => 'YourUserEntityClass' //TODO
          ],
      ];

and your User class must extends `RbacUserDoctrineOrm\Domain\AbstractRbacUser`

# TODO
- need more test on different version on depended module
- more documentation
- will release 0.x version soon.

# Author
Mr. Siwapun Siwaporn
map.siwapun@gmail.com

feel free to ask or suggest me. :)
