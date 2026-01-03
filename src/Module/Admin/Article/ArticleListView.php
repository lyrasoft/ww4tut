<?php

declare(strict_types=1);

namespace App\Module\Admin\Article;

use App\Entity\Article;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\Filter;
use Windwalker\Core\Attributes\Request\Input;
use Windwalker\Core\Attributes\Request\InputCompact;
use Windwalker\Core\Attributes\ViewMetadata;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Attributes\ViewPrepare;
use Windwalker\Core\Form\FormFactory;
use Windwalker\Core\Html\HtmlFrame;
use Windwalker\Core\Pagination\PaginationFactory;
use Windwalker\Core\View\View;
use Windwalker\Data\Collection;
use Windwalker\ORM\ORM;
use Windwalker\Query\Query;

#[ViewModel(
    layout: 'article-list',
    js: 'article-list.ts'
)]
class ArticleListView
{
    public function __construct(
        protected ORM $orm,
        protected PaginationFactory $paginationFactory,
        protected FormFactory $formFactory,
    ) {
        //
    }

    #[ViewPrepare]
    public function prepare(
        AppContext $app,
        View $view,
        #[Input, Filter('int|range(min: 1)')]
        ?int $page = null,
        #[InputCompact('q', 'state')] Collection $filter = new Collection(),
    ): array {
        $limit = 5;

        [$q, $state] = $filter->values()->dump();

        $query = $this->orm->from(Article::class)
            // Add state where, if filter exists.
            ->tapIf(
                (string) $state !== '',
                fn(Query $query) => $query->where('state', '=', $state)
            )
            ->offset(($page - 1) * $limit)
            ->order('id', 'DESC')
            ->limit($limit);

        // Add search
        if ($q !== '') {
            $query->orWhere(
                function (Query $query) use ($q) {
                    $query->where('title', 'like', '%' . $q . '%');
                    $query->where('content', 'like', '%' . $q . '%');
                }
            );
        }

        $pagination = $this->paginationFactory->create($page, $limit)
            ->total(fn() => $this->orm->countWith($query));

        $items = $query->getIterator(Article::class);

        $form = $this->formFactory->create(ArticleGridForm::class)
            // Fill q and state value to form
            ->fill(
                [
                    'q' => $q,
                    'state' => $state,
                ]
            );

        return compact('items', 'pagination', 'form');
    }

    #[ViewMetadata]
    public function prepareMetadata(HtmlFrame $htmlFrame): void
    {
        $htmlFrame->setTitle('文章管理');
    }
}
