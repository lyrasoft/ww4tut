<?php

declare(strict_types=1);

namespace App\Module\Admin\Article;

use App\Entity\Article;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\Filter;
use Windwalker\Core\Attributes\Request\Input;
use Windwalker\Core\Attributes\ViewMetadata;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Attributes\ViewPrepare;
use Windwalker\Core\Form\FormFactory;
use Windwalker\Core\Html\HtmlFrame;
use Windwalker\Core\View\View;
use Windwalker\ORM\ORM;

#[ViewModel(
    layout: 'article-edit',
    js: 'article-edit.js'
)]
class ArticleEditView
{
    public function __construct(
        protected ORM $orm,
        protected FormFactory $formFactory
    ) {
        //
    }

    #[ViewPrepare]
    public function prepare(
        AppContext $app,
        View $view,
        #[Input, Filter('int')] ?int $id = null
    ): array {
        $item = $this->orm->findOne(Article::class, $id);

        $form = $this->formFactory->create(ArticleEditForm::class)
            ->fill($this->orm->extractEntity($item));

        return compact('item', 'form');
    }

    #[ViewMetadata]
    public function viewMetadata(HtmlFrame $htmlFrame): void
    {
        $htmlFrame->setTitle('文章編輯');
    }
}
