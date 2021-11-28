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
use App\Module\Admin\Article\Form\GridForm;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Form\FormFactory;
use Windwalker\Core\Pagination\PaginationFactory;
use Windwalker\Core\View\View;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\ORM\ORM;

use Windwalker\Query\Query;

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
        protected PaginationFactory $paginationFactory,
        protected FormFactory $formFactory,
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

        $q = (string) $app->input('q');
        $state = $app->input('state');

        $query = $this->orm->from(Article::class)
            ->tapIf(
                (string) $state !== '',
                fn (Query $query) => $query->where('state', '=', $state)
            )
            ->offset(($page - 1) * $limit)
            ->limit($limit);

        if ($q !== '') {
            $query->orWhere(
                function (Query $query) use ($q) {
                    $query->where('title', 'like', '%' . $q . '%');
                    $query->where('content', 'like', '%' . $q . '%');
                }
            );
        }

        $pagination = $this->paginationFactory->create($page, $limit)
            ->total(fn () => $this->orm->countWith($query));

        $items = $query->getIterator(Article::class);

        $form = $this->formFactory->create(GridForm::class)
            ->fill(
                [
                    'q' => $q,
                    'state' => $state
                ]
            );

        $view->setTitle('文章管理');

        return compact('items', 'pagination', 'form');
    }
}
