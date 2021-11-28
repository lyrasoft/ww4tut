<?php

namespace App\Routes;

use App\Module\Admin\Article\ArticleController;
use App\Module\Admin\Article\ArticleEditView;
use App\Module\Admin\Article\ArticleListView;
use Windwalker\Core\Router\RouteCreator;

/** @var RouteCreator $router */

$router->group('article')
    ->register(function (RouteCreator $router) {
        $router->any('article_list', '/article/list')
            ->controller(ArticleController::class)
            ->view(ArticleListView::class);

        // Add this route
        $router->any('article_edit', '/article/edit[/{id}]')
            ->controller(ArticleController::class)
            ->view(ArticleEditView::class);
    });
