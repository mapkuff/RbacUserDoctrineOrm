# RbacUserDoctrineOrm
ZF Module which in integrate [ZfcUserDoctrineOrm](https://github.com/ZF-Commons/ZfcUserDoctrineORM) with [ZfcRbac](https://github.com/ZF-Commons/zfc-rbac).
Inspired by https://github.com/esserj/RbacUserDoctrineOrm

Dependencies
------------

- [ZfcUser](https://github.com/ZF-Commons/ZfcUser)
- [ZfcUserDoctrineOrm](https://github.com/ZF-Commons/ZfcUserDoctrineORM)
- [DoctrineModule](https://github.com/doctrine/DoctrineModule)
- [DoctrineORMModule](https://github.com/doctrine/DoctrineORMModule)
- [ZfcRbac](https://github.com/ZF-Commons/zfc-rbac)

Installation
------------

Install RbacUserDoctrineOrm Module using composer

    php composer.phar require evilband7/rbac-user-doctrine-orm:dev-master


Set up your Modules in `config/application/application.config.php`, something like

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
[Facebook](https://www.facebook.com/maptwoza?ref=bookmarks)
[Twitter](https://twitter.com/siwapun)
[LinkedIn](https://www.linkedin.com/in/siwapun-siwaporn-3b060594)
map.siwapun@gmail.com

feel free to ask or suggest me. :)