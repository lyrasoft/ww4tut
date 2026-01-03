<?php

declare(strict_types=1);

namespace App\Module\Admin\Article;

use Windwalker\Form\Attributes\FormDefine;
use Windwalker\Form\Field\ListField;
use Windwalker\Form\Field\SearchField;
use Windwalker\Form\Form;

class ArticleGridForm
{
    #[FormDefine]
    public function filter(Form $form): void
    {
        $form->add('q', SearchField::class)
            ->label('搜尋')
            ->placeholder('輸入搜尋字串')
            ->addClass('form-control');

        $form->add('state', ListField::class)
            ->label('啟用狀態')
            ->addClass('form-select')
            ->option('- 請選擇 -', '')
            ->option('啟用中', '1')
            ->option('已關閉', '0')
            ->onchange('this.form.submit()');
    }
}
