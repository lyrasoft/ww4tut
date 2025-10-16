<?php

declare(strict_types=1);

namespace App\Module\Front\Article;

use App\Entity\Article;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\Assert;
use Windwalker\Core\Attributes\Filter;
use Windwalker\Core\Attributes\Request\Input;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Attributes\ViewPrepare;
use Windwalker\Core\Pagination\PaginationFactory;
use Windwalker\Core\View\View;
use Windwalker\ORM\ORM;

use function Windwalker\filter;

#[ViewModel(
    layout: 'article-list',
    js: 'article-list.js'
)]
class ArticleListView
{
    public function __construct(protected ORM $orm, protected PaginationFactory $paginationFactory)
    {
        //
    }

    #[ViewPrepare]
    public function prepare(
        AppContext $app,
        View $view,
        #[Input, Filter('int'), Assert('range(min: 1)')]
        ?int $page = null,
    ): array {
        $limit = 5;

        $query = $this->orm->from(Article::class)
            ->where('state', 1)
            ->offset(($page - 1) * $limit) // 計算 offset
            ->limit($limit);

        // 建立 pagination 物件
        $pagination = $this->paginationFactory->create($page, $limit)
            // 計算 total，用 ORM::countWith()
            ->total(fn () => $this->orm->countWith($query));

        $items = $query->getIterator(Article::class);

        return compact('items', 'pagination');
    }
}
