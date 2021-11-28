<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Article\Form;

use Windwalker\Form\Field\HiddenField;
use Windwalker\Form\Field\ListField;
use Windwalker\Form\Field\SearchField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;

/**
 * The EditForm class.
 */
class GridForm implements FieldDefinitionInterface
{
    /**
     * Define the form fields.
     *
     * @param  Form  $form  The Windwalker form object.
     *
     * @return  void
     */
    public function define(Form $form): void
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
