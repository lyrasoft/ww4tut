<?php

declare(strict_types=1);

namespace App\Module\Front\Article;

use App\Entity\Article;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\Request\Input;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Attributes\ViewPrepare;
use Windwalker\Core\Router\Exception\RouteNotFoundException;
use Windwalker\Core\View\View;
use Windwalker\ORM\ORM;

use function Windwalker\str;

#[ViewModel(
    layout: 'article-item',
    js: 'article-item.js'
)]
class ArticleItemView
{
    /**
     * Constructor.
     */
    public function __construct(protected ORM $orm)
    {
        //
    }

    #[ViewPrepare]
    public function prepare(AppContext $app, View $view, #[Input] string $id): array
    {
        $item = $this->orm->findOne(Article::class, $id);

        if (!$item) {
            throw new RouteNotFoundException();
        }

        $view->setTitle($item->title);

        $htmlFrame = $view->getHtmlFrame();
        $htmlFrame->addMetadata(
            'description',
            str($item->content)->stripHtmlTags()->truncate(100, '...'),
            true // 設定 TRUE 覆蓋之前的 metadata
        );
        $htmlFrame->addOpenGraph(
            'og:image',
            $item->image,
            true
        );

        return compact('item');
    }
}
