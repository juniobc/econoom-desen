<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Anuncio\Controller\Anuncio' => 'Anuncio\Controller\AnuncioController',
        ),
    ),
    
    'router' => array(
        'routes' => array(
            'anuncio' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/anuncio[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Anuncio\Controller\Anuncio',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    
    
    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy'
        )
    ),
    
    
);