<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Nr12\Controller\Titulo'    => 'Nr12\Controller\TituloController',
            'Nr12\Controller\Subtitulo' => 'Nr12\Controller\SubtituloController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'titulo' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/titulo[/][:action][/:id]',
                    'constraints' => array(
                        'action'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'      => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Nr12\Controller\Titulo',
                        'action'     => 'index',
                    ),
                ),
            ),
            'subtitulo' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/subtitulo[/][:action][/:id]',
                    'constraints' => array(
                        'action'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'      => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Nr12\Controller\Subtitulo',
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