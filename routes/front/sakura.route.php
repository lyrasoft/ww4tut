<?php

declare(strict_types=1);

namespace App\Routes;

use App\Module\Front\Sakura\SakuraView;
use Windwalker\Core\Router\RouteCreator;

/** @var RouteCreator $router */

$router->group('sakura')
    ->register(function (RouteCreator $router) {
        $router->any('sakura', '/sakura')
            ->view(SakuraView::class);
    });
