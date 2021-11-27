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
use Windwalker\Core\Pagination\PaginationFactory;
use Windwalker\Core\View\View;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\ORM\ORM;

use function Windwalker\filter;

/**
 * The ArticleListView class.
 */
#[ViewModel(
    layout: 'article-list',
    js: 'article-list.js'
)]
class ArticleListView implements ViewModelInterface
{
    /**
     * Constructor.
     */
    public function __construct(
        protected ORM $orm,
        protected PaginationFactory $paginationFactory
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
        $page = (int) $app->input('page');
        $limit = 5;

        $page = filter($page, 'int|range(min=1)');

        $query = $this->orm->from(Article::class)
            ->where('state', 1) // 限制只有 state = 1 的取出
            ->offset(($page - 1) * $limit)
            ->limit($limit);

        $pagination = $this->paginationFactory->create($page, $limit)
            ->total(fn () => $this->orm->countWith($query));

        $items = $query->getIterator(Article::class);

        return compact('items', 'pagination');
    }
}
