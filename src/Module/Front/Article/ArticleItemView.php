<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Front\Article;

use App\Entity\Article;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Router\Exception\RouteNotFoundException;
use Windwalker\Core\View\View;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\ORM\ORM;

use function Windwalker\str;

/**
 * The ArticleItemView class.
 */
#[ViewModel(
    layout: 'article-item',
    js: 'article-item.js'
)]
class ArticleItemView implements ViewModelInterface
{
    /**
     * Constructor.
     */
    public function __construct(
        protected ORM $orm
    ) {
        //
    }

    /**
     * Prepare View.
     *
     * @param  AppContext  $app   The web app context.
     * @param  View        $view  The view object.
     *
     * @return  mixed
     */
    public function prepare(AppContext $app, View $view): array
    {
        $id = $app->input('id');

        $item = $this->orm->findOne(Article::class, $id);

        if (!$item) {
            throw new RouteNotFoundException();
        }

        $view->setTitle($item->getTitle());

        $htmlFrame = $view->getHtmlFrame();
        $htmlFrame->setDescription(
            (string) str($item->getContent())->stripHtmlTags()->truncate(100, '...'),
        );
        $htmlFrame->setCoverImages($item->getImage());

        return compact('item');
    }
}
