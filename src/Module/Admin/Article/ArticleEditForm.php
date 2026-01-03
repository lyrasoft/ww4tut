<?php

declare(strict_types=1);

namespace App\Module\Admin\Article;

use Windwalker\Form\Attributes\Fieldset;
use Windwalker\Form\Field\HiddenField;
use Windwalker\Form\Attributes\FormDefine;
use Windwalker\Form\Field\RadioField;
use Windwalker\Form\Field\TextareaField;
use Windwalker\Form\Field\TextField;
use Windwalker\Form\Form;

class ArticleEditForm
{
    #[FormDefine]
    #[Fieldset('basic')]
    public function basic(Form $form): void
    {
        $form->add('id', HiddenField::class);

        $form->add('title', TextField::class)
            ->label('標題')
            ->addClass('form-control')
            ->addFilter('trim')
            ->required(true)
            ->maxlength(255);

        $form->add('state', RadioField::class)
            ->label('狀態')
            ->option('啟用', '1')
            ->option('關閉', '0');

        $form->add('content', TextareaField::class)
            ->label('內容')
            ->addClass('form-control')
            ->rows(10);
    }
}
