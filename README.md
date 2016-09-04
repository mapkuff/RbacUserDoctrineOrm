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


# TODO
- need more test on different version on depended module
- more documentation
- will release 0.x version soon.

# Author
Mr. Siwapun Siwaporn
map.siwapun@gmail.com

feel free to ask or suggest me. :)
