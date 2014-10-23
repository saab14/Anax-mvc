<?php

/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar',
    // Here comes the menu strcture
    'items' => [
        // This is a menu item
        'home' => [
            'text' => 'Hem',
            'url' => '',
            'title' => 'Min me-sida'
        ],
        // This is a menu item
        'reports' => [
            'text' => 'Redovisning',
            'url' => 'redovisning',
            'title' => 'Redovisning',
            
            'submenu' => [
                'items' => [
                     'item 1'  => [
                        'text'  => 'kmom01',   
                        'url'   => 'kmom01',  
                        'title' => 'kmom01 redovisning'
                    ],
                    'item 2'  => [
                        'text'  => 'kmom02',   
                        'url'   => 'kmom02',  
                        'title' => 'kmom02 redovisning'
                    ],
                    'item 3'  => [
                        'text'  => 'kmom03',   
                        'url'   => 'kmom03',  
                        'title' => 'kmom03 redovisning'
                    ],
					'item 4'  => [
                        'text'  => 'kmom04',   
                        'url'   => 'kmom04',  
                        'title' => 'kmom04 redovisning'
                    ],
                ],
            ],
        ], 
		'newTheme' => [ 
            'text'  => 'Tema', 
            'url'   => 'fontochtypografi', 
            'title' => 'Tema',  

            'submenu' => [ 
                'items' => [ 


                    // This is a menu item of the submenu 
                    'regioner'  => [ 
                        'text'  => 'Regioner',    
                        'url'   => 'regioner',   
                        'title' => 'Regioner' 
                    ], 

                    // This is a menu item of the submenu 
                    'font och typografi'  => [ 
                        'text'  => 'Font och typografi',    
                        'url'   => 'fontochtypografi',   
                        'title' => 'Font och typografi' 
                    ], 
                ], 
            ], 
        ], 
		
		         'users' => [
            'text' => 'Användare',
            'url' => 'users',
            'title' => 'Test av användare och CForm',
            'submenu' => [
                'items' => [
                    'add' => [
                        'text' => 'Lägg till',
                        'url' => 'users/add',
                        'title' => 'Lägg till en användare'
                    ],
                    'list' => [
                        'text' => 'Lista alla',
                        'url' => 'users/list',
                        'title' => 'Lista alla användare'
                    ],
                    'active' => [
                        'text' => 'Lista aktiva',
                        'url' => 'users/active',
                        'title' => 'Lista aktiva användare'
                    ],
                    'inactive' => [
                        'text' => 'Lista inaktiva',
                        'url' => 'users/inactive',
                        'title' => 'Lista inaktiva användare'
                    ],
                    

                     'separator0' => '--',

                    'deleted' => [
                        'text' => 'Lista borttagna användare',
                        'url' => 'users/trashcan',
                        'title' => 'Lista raderade användare'
                    ],
                    
                    'delete' => [
                        'text' => 'Ta bort användare',
                        'url' => 'users/delete',
                        'title' => 'Ta bort en användare'
                    ],

                     'restore' => [
                        'text' => 'Återställ användare',
                        'url' => 'users/restore',
                        'title' => 'Återställ en raderad användare'
                    ],


                    'separator1' => '--',

                    'deactivate' => [
                        'text' => 'Inaktivera',
                        'url' => 'users/deactivate',
                        'title' => 'Inaktivera en användare'
                    ],

                    'activate' => [
                        'text' => 'Aktivera en användare',
                        'url' => 'users/activate',
                        'title' => 'Aktivera en inaktiv användare'
                    ],

                    'separator2' => '--',

                    'setup' => [
                        'text' => 'Återställ databas',
                        'url' => 'users/setup',
                        'title' => 'Återställ användartabellen'
                    ]
                ]
            ]
        ],
    
        // This is a menu item
        'about' => [
            'text' => 'Källkod',
            'url' => 'source',
            'title' => 'Källkod'
        ],
    ],
    // Callback tracing the current selected menu item base on scriptname
    'callback' => function($url) {
        if ($url == $this->di->get('request')->getRoute()) {
            return true;
        }
    },
    // Callback to create the urls
    'create_url' => function($url) {
        return $this->di->get('url')->create($url);
    },
]; 