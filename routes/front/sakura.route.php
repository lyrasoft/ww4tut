<?php

namespace App\Routes;

use App\Module\Front\Sakura\SakuraView;
use Windwalker\Core\Router\RouteCreator;

/** @var RouteCreator $router */

$router->group('sakura')
    ->register(function (RouteCreator $router) {
        $router->group('sakura')
            ->register(function (RouteCreator $router) {
                // Add this
                $router->any('sakura', '/sakura')
                    ->view(SakuraView::class);

            });
    });
