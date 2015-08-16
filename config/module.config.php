<?php

return array(

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'display_exceptions' => true,
        'display_not_found_reason' => true,
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),

    'router' => array(
        'routes' => array(
            'admin-lists' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/lists[/:type]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webLists\Controller\Admin',
                        'controller' => 'List',
                        'action' => 'default',
                    ),
                ),
            ),
            'admin-list-add' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/list/add',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webLists\Controller\Admin',
                        'controller' => 'Add',
                        'action' => 'default',
                    ),
                ),
            ),
            'admin-list-edit' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/list/edit[/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webLists\Controller\Admin',
                        'controller' => 'Add',
                        'action' => 'default',
                    ),
                ),
            ),
            'admin-list-delete' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/list/delete[/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'T4webLists\Controller\Admin',
                        'controller' => 'Add',
                        'action' => 'delete',
                    ),
                ),
            ),
        ),
    ),

    'view_helpers' => array(
        'invokables' => array(
            'renderForm' => 'T4webLists\View\Helper\RenderForm',
            'formElementErrors' => 'T4webLists\View\Helper\FormElementErrors',
        ),
    ),

    'console' => array(
        'router' => array(
            'routes' => array(
                'lists-init' => array(
                    'options' => array(
                        'route' => 'lists init',
                        'defaults' => array(
                            '__NAMESPACE__' => 'T4webLists\Controller\Console',
                            'controller' => 'Init',
                            'action' => 'run'
                        )
                    )
                ),
            )
        )
    ),

    'db' => array(
        'tables' => array(
            't4weblists-objectlist' => array(
                'name' => 'lists',
                'columnsAsAttributesMap' => array(
                    'id' => 'id',
                    'name' => 'name',
                    'type' => 'type',
                ),
            ),
        ),
    ),

    'criteries' => array(
        'ObjectList' => array(
            'empty' => array(
                'table' => 'lists',
            ),
            'id' => array(
                'table' => 'lists',
                'field' => 'id',
                'buildMethod' => 'addFilterEqual',
            ),
            'ids' => array(
                'table' => 'lists',
                'field' => 'id',
                'buildMethod' => 'addFilterIn',
            ),
            'type' => array(
                'table' => 'lists',
                'field' => 'type',
                'buildMethod' => 'addFilterEqual',
            ),
            'types' => array(
                'table' => 'lists',
                'field' => 'type',
                'buildMethod' => 'addFilterIn',
            ),
        ),
    ),
);
