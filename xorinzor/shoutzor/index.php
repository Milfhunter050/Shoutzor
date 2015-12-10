<?php

use Pagekit\Application;

/*
 * This array is the module definition.
 * It's used by Pagekit to load your extension and register all things
 * that your extension provides (routes, menu items, php classes etc)
 */
return [

    /*
     * Define a unique name.
     */
    'name' => 'shoutzor',

    /*
     * Define the type of this module.
     * Has to be 'extension' here. Can be 'theme' for a theme.
     */
    'type' => 'extension',

    /*
     * Main entry point. Called when your extension is both installed and activated.
     * Either assign an closure or a string that points to a PHP class.
     * Example: 'main' => 'Pagekit\\Hello\\HelloExtension'
     */
    'main' => function (Application $app) {

        // bootstrap code

    },

    /*
     * Register all namespaces to be loaded.
     * Map from namespace to folder where the classes are located.
     * Remember to escape backslashes with a second backslash.
     */
    'autoload' => [

        'Xorinzor\\Shoutzor\\' => 'src'

    ],

    /*
     * Define nodes. A node is similar to a route with the difference
     * that it can be placed anywhere in the menu structure. The
     * resulting route is therefore determined on runtime.
     */
    'nodes' => [

        'shoutzor/home' => [

            // The name of the node route
            'name' => '@shoutzor/home',

            // Label to display in the backend
            'label' => 'Dashboard',

            // The controller for this node. Each controller action will be mounted
            'controller' => 'Xorinzor\\Shoutzor\\Controller\\SiteController::indexAction',

            // A unique node that cannot be deleted, resides in "Not Linked" by default
            'protected' => true,

            'frontpage' => true,

            'active' => '@shoutzor/home'

        ],

        'shoutzor/visualizer' => [

            // The name of the node route
            'name' => '@shoutzor/visualizer',

            // Label to display in the backend
            'label' => 'Shoutzor Visualizer',

            // The controller for this node. Each controller action will be mounted
            'controller' => 'Xorinzor\\Shoutzor\\Controller\\SiteController::visualizerAction',

            // A unique node that cannot be deleted, resides in "Not Linked" by default
            'protected' => true,

            'active' => '@shoutzor/visualizer'

        ],

        'shoutzor/uploadmanager' => [

            // The name of the node route
            'name' => '@shoutzor/uploadmanager',

            // Label to display in the backend
            'label' => 'Upload manager',

            // The controller for this node. Each controller action will be mounted
            'controller' => 'Xorinzor\\Shoutzor\\Controller\\SiteController::uploadManagerAction',

            // A unique node that cannot be deleted, resides in "Not Linked" by default
            'protected' => true,

            'active' => '@shoutzor/uploadmanager'

        ],

        'shoutzor/search' => [

            // The name of the node route
            'name' => '@shoutzor/search',

            // Label to display in the backend
            'label' => 'Search',

            // The controller for this node. Each controller action will be mounted
            'controller' => 'Xorinzor\\Shoutzor\\Controller\\SiteController::searchAction',

            // A unique node that cannot be deleted, resides in "Not Linked" by default
            'protected' => true,

            'active' => '@shoutzor/search'

        ]

    ],


    /*
     * Define routes.
     */
    'routes' => [
        '/shoutzor' => [
            'name' => '@shoutzor/admin',
            'controller' => [
                'Xorinzor\\Shoutzor\\Controller\\ShoutzorController'
            ]
        ],

        '/shoutzor/visualizer' => [
            'name' => '@shoutzor/admin/visualizer',
            'controller' => [
                'Xorinzor\\Shoutzor\\Controller\\VisualizerController'
            ]
        ],

        '/shoutzor/playlist' => [
            'name' => '@shoutzor/admin/playlist',
            'controller' => [
                'Xorinzor\\Shoutzor\\Controller\\PlaylistController'
            ]
        ],

        '/shoutzor/liquidsoap' => [
            'name' => '@shoutzor/admin/liquidsoap',
            'controller' => [
                'Xorinzor\\Shoutzor\\Controller\\LiquidsoapController'
            ]
        ]

    ],

    /*
     * Define menu items for the backend.
     */
    'menu' => [

        // name, can be used for menu hierarchy
        'shoutzor' => [

            // Label to display
            'label' => 'Shoutzor',

            // Icon to display
            'icon' => 'shoutzor:icon.png',

            // URL this menu item links to
            'url' => '@shoutzor/admin',

            // Optional: Expression to check if menu item is active on current url
            // 'active' => '@hello*'

            // Optional: Limit access to roles which have specific permission assigned
            'access' => 'shoutzor: manage shoutzor'
        ],

        'shoutzor: settings' => [

            // Parent menu item, makes this appear on 2nd level
            'parent' => 'shoutzor',

            // See above
            'label' => 'Shoutzor',
            'icon' => 'shoutzor:icon.png',
            'url' => '@shoutzor/admin',
            'access' => 'shoutzor: manage shoutzor'
        ],

        'shoutzor: visualizer' => [
            'parent' => 'shoutzor',
            'label' => 'Visualizer',
            'url' => '@shoutzor/admin/visualizer',
            'access' => 'shoutzor: manage visualizer settings'
        ],

        'shoutzor: playlist' => [
            'parent' => 'shoutzor',
            'label' => 'Playlist',
            'url' => '@shoutzor/admin/playlist',
            'access' => 'shoutzor: manage playlist settings'
        ],

        'shoutzor: liquidsoap' => [
            'parent' => 'shoutzor',
            'label' => 'LiquidSoap',
            'url' => '@shoutzor/admin/liquidsoap',
            'access' => 'shoutzor: manage liquidsoap settings'
        ]

    ],

    /*
     * Define permissions.
     * Will be listed in backend and can then be assigned to certain roles.
     */
    'permissions' => [

        // Unique name.
        // Convention: extension name and speaking name of this permission (spaces allowd)
        'shoutzor: manage shoutzor' => [
            'title' => 'Manage Shoutzor Settings'
        ],

        'shoutzor: manage visualizer settings' => [
            'title' => 'Manage Shoutzor Visualizer Settings'
        ],

        'shoutzor: manage playlist settings' => [
            'title' => 'Manage Shoutzor Playlist Settings'
        ],

        'shoutzor: manage liquidsoap settings' => [
            'title' => 'Manage Shoutzor Liquidsoap Service Settings'
        ],

        'shoutzor: upload files' => [
            'title' => 'Upload files to shoutzor'
        ],

        'shoutzor: add requests' => [
            'title' => 'Make requests for the shoutzor playlist'
        ]

    ],

    /*
     * Link to a settings screen from the extensions listing.
     */
    'settings' => '@shoutzor/admin',

    /*
     * Default module configuration.
     * Can be overwritten by changed config during runtime.
     */
    'config' => [

        'search' => [
            'results_per_page' => 10,
            'max_results_per_page' => 20
        ],

        'shoutzor' => [
            'enable_uploads' => 2
        ],

        'visualizer' => [
            'enabled' => 1,
        ],

        'liquidsoap' => [
        ]

    ],

    /*
     * Listen to events.
     */
    'events' => [

        'view.scripts' => function ($event, $scripts) {
            $scripts->register('shoutzor-settings', 'shoutzor:app/bundle/settings.js', '~extensions');
        }

    ]

];
