<?php

/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/*
 * This file is loaded in the context of the `Application` class.
  * So you can use  `$this` to reference the application class instance
  * if required.
 */

return function (RouteBuilder $routes): void {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {
        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        $builder->connect('/', ['controller' => 'Home', 'action' => 'index']);

        // Legal
        $builder->connect('/legal', ['controller' => 'Pages', 'action' => 'display', 'legal']);

        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        $builder->connect('/pages/*', 'Pages::display');

        $builder->connect(
            '/user/{user_uid}',
            ['controller' => 'Users', 'action' => 'view']
        )
            ->setPatterns(
                [
                    'user_uid' => '[a-z0-9_\-\.]+',
                ]
            )
            ->setPass(['user_uid']);

        $builder->connect(
            '/deck/{deck_uid}',
            ['controller' => 'Packets', 'action' => 'view']
        )
            ->setPatterns(
                [
                    'deck_uid' => '[a-z0-9\-]+',
                ]
            )
            ->setPass(['deck_uid']);

        $builder->connect(
            '/deck/settings/{deck_uid}',
            ['controller' => 'Packets', 'action' => 'settings']
        )
            ->setPatterns(
                [
                    'deck_uid' => '[a-z0-9\-]+',
                ]
            )
            ->setPass(['deck_uid']);

        $builder->connect(
            '/market/{category}',
            ['controller' => 'Market', 'action' => 'category']
        )
            ->setPatterns(
                [
                    'category' => '[a-z0-9\-]+',
                ]
            )
            ->setPass(['category']);

        $builder->connect(
            '/articles/{article_name}',
            ['controller' => 'Articles', 'action' => 'view']
        )
            ->setPatterns(
                [
                    'article_name' => '[a-z0-9\-]+',
                ]
            )
            ->setPass(['article_name']);

        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $builder->connect('/{controller}', ['action' => 'index']);
         * $builder->connect('/{controller}/{action}/*', []);
         * ```
         *
         * You can remove these routes once you've connected the
         * routes you want in your application.
         */
        $builder->fallbacks();
    });


    /*
     * Routes for the Leitlearn API
     */
    $routes->scope('/api', function (RouteBuilder $builder): void {
        $builder->connect(
            '/explore/get/{query}',
            ['controller' => 'Packets', 'action' => 'get']
        )
            ->setPatterns(
                [
                    'query' => '[a-z0-9\-]+',
                ]
            )
            ->setPass(['query']);

        $builder->connect(
            '/explore/get/{query}/{category}',
            ['controller' => 'Packets', 'action' => 'get']
        )
            ->setPatterns(
                [
                    'query' => '[a-zA-Z0-9\-]*',
                    'category' => '[a-zA-Z0-9\-]*',
                ]
            )
            ->setPass(['query', 'category']);

        $builder->connect(
            '/market/get/{id}',
            ['controller' => 'Packets', 'action' => 'getMarket']
        )
            ->setPatterns(
                [
                    'id' => '\d+',
                ]
            )
            ->setPass(['id']);

        $builder->connect(
            '/flashcard/get/{id}',
            ['controller' => 'Flashcards', 'action' => 'get']
        )
            ->setPatterns(
                [
                    'id' => '\d+',
                ]
            )
            ->setPass(['id']);

        $builder->connect(
            '/users/get/{query}',
            ['controller' => 'Users', 'action' => 'get']
        )
            ->setPatterns(
                [
                    'query' => '[a-z0-9\-]+',
                ]
            )
            ->setPass(['query']);

        $builder->connect(
            '/ai/request/{query}',
            ['controller' => 'Ai', 'action' => 'request']
        )
            ->setPatterns(
                [
                    'query' => '.*',
                ]
            )
            ->setPass(['query']);

        $builder->connect(
            '/likes/get/{id}',
            ['controller' => 'Likes', 'action' => 'get']
        )
            ->setPatterns(
                [
                    'id' => '\d+',
                ]
            )
            ->setPass(['id']);
    });
};
