<?php
return [

    'service_manager' => [
        'aliases' => [
            'Zend\Authentication\AuthenticationService' => 'zfcuser_auth_service'
        ],
        'factories' => [
            'RbacUserDoctrineOrm\Options\ModuleOptions' => 'RbacUserDoctrineOrm\Factory\ModuleOptionsFactory'
        ],
        'delegators' => [
            'ZfcUser\Authentication\Storage\Db' => [
                0=> 'RbacUserDoctrineOrm\Factory\ZfcUserDoctrineStorageDelegatorFactory'
            ],
        ],

    ],

    'rbac-user-doctrine-orm' => [
        'enable_default_user_entity' => true,
    ],
    
    
    'zfc_rbac' => [
        'role_provider' => [
            'ZfcRbac\Role\InMemoryRoleProvider' => [
                'admin' => [
                    'children'    => ['member'],
                    'permissions' => ['article.delete']
                ],
            ]
        ]
    ],
    
    'zfcuser' => [
        'enable_default_entities' => false,
        'userEntityClass' => 'RbacUserDoctrineOrm\Domain\ConcreteImpl\User'
    ],
    
    'doctrine' => [
        'driver' => array(
            'RbacUserDoctrineDomain' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => __DIR__ . '/xml/doctrine/rbac-user'
            ),

            'orm_default' => array(
                'drivers' => array(
                    'RbacUserDoctrineOrm\Domain'  => 'RbacUserDoctrineDomain'
                )
            )
        )
    ],

    'view_manager' => [
        'template_map' => [
            'error/403' => __DIR__ . '/../view/error/403.phtml',
        ]
    ],
];