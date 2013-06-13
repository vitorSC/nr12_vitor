<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Nr12\Controller\Produto'    => 'Nr12\Controller\ProdutoController',
            'Nr12\Controller\Categoria'  => 'Nr12\Controller\CategoriaController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'produto' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/produto[/][:action][/:id]',
                    'constraints' => array(
                        'action'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'      => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Nr12\Controller\Produto',
                        'action'     => 'index',
                    ),
                ),
            ),
            'categoria' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/categoria[/][:action][/:id]',
                    'constraints' => array(
                        'action'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'      => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Nr12\Controller\Categoria',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'titulo'    => __DIR__ . '/../view',
            'subtitulo' => __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Nr12/Model')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Nr12\Model' => 'application_entities'
                ),
            ),
        ),
    ),
);