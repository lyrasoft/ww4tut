<?php

declare(strict_types=1);

namespace App\Module\Admin\Article;

use App\Entity\Article;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\Controller;
use Windwalker\Core\Attributes\Request\Input;
use Windwalker\Core\Attributes\Request\InputCompact;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\RouteUri;
use Windwalker\Data\Collection;
use Windwalker\ORM\ORM;

#[Controller]
class ArticleController
{
    public function save(
        AppContext $app,
        ORM $orm,
        Navigator $nav,
        #[InputCompact('id', 'title', 'state', 'content')] Collection $item = new Collection()
    ) {
        /** @var Article $item */
        $item = $orm->saveOne(Article::class, $item);

        $app->addMessage('儲存成功', 'success');

        return $nav->to('article_list');
    }

    public function delete(
        AppContext $app,
        ORM $orm,
        Navigator $nav,
        #[Input] string $id,
    ): RouteUri {
        $orm->deleteWhere(Article::class, (int) $id);

        $app->addMessage('刪除項目成功', 'success');

        return $nav->to('article_list');
    }
}
