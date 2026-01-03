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
    /**
     * Constructor.
     */
    public function __construct(
        protected ORM $orm,
        protected PaginationFactory $paginationFactory
    ) {
        //
    }

    #[ViewPrepare]
    public function prepare(
        AppContext $app,
        View $view,
        #[Input, Filter('int'), Assert('range(min: 1)')] int $page = 1,
    ): array {
        $limit = 5;

        $query = $this->orm->from(Article::class)
            // 只有 state = 1 的取出
            ->where('state', 1)
            // 計算 offset
            ->offset(($page - 1) * $limit)
            ->limit($limit);

        // 建立 pagination 物件
        $pagination = $this->paginationFactory->create($page, $limit)
            // 計算 total，用 ORM::countWith()
            ->total(fn() => $this->orm->countWith($query));

        // 用 iterator 取回，而不是一次全部返回，在 foreach 之前沒有真的拿到東西
        $items = $query->getIterator(Article::class);

        $view->setTitle('文章列表');

        return compact('items', 'pagination');
    }
}
