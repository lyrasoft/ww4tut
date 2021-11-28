<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Article;

use App\Entity\Article;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\Controller;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\RouteUri;
use Windwalker\ORM\ORM;

/**
 * The ArticleController class.
 */
#[Controller(
    config: __DIR__ . '/article.config.php'
)]
class ArticleController
{
    public function save(AppContext $app, ORM $orm, Navigator $nav)
    {
        $item = $app->input('id', 'title', 'state', 'content')->dump();

        /** @var Article $item */
        $item = $orm->saveOne(Article::class, $item);

        $app->addMessage('儲存成功', 'success');

        return $nav->to('article_list');
    }

    public function delete(AppContext $app, ORM $orm, Navigator $nav): RouteUri
    {
        $id = $app->input('id');

        $orm->deleteWhere(Article::class, $id);

        $app->addMessage('刪除項目成功', 'success');

        return $nav->to('article_list');
    }
}
