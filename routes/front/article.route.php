<?php

namespace App\Routes;

use App\Module\Front\Article\ArticleItemView;
use App\Module\Front\Article\ArticleListView;
use Windwalker\Core\Router\RouteCreator;

/** @var RouteCreator $router */

$router->group('article')
    ->register(function (RouteCreator $router) {
        $router->any('article_list', '/article/list')
            ->view(ArticleListView::class);

        $router->any('article_item', '/article/{id}')
            ->view(ArticleItemView::class);
    });
