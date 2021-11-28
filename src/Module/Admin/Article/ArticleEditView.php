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
use App\Module\Admin\Article\Form\EditForm;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Form\FormFactory;
use Windwalker\Core\View\View;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\ORM\ORM;

/**
 * The ArticleEditView class.
 */
#[ViewModel(
    layout: 'article-edit',
    js: 'article-edit.js'
)]
class ArticleEditView implements ViewModelInterface
{
    /**
     * Constructor.
     */
    public function __construct(
        protected ORM $orm,
        protected FormFactory $formFactory
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

        $form = $this->formFactory->create(EditForm::class)
            ->fill($this->orm->extractEntity($item));

        $view->setTitle('文章編輯');

        return compact('item', 'form');
    }
}
