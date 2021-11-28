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
use Windwalker\Form\Field\RadioField;
use Windwalker\Form\Field\TextareaField;
use Windwalker\Form\Field\TextField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;

/**
 * The EditForm class.
 */
class EditForm implements FieldDefinitionInterface
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
        $form->fieldset(
            'basic',
            function (Form $form) {
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
        );
    }
}
