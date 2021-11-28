<?php

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app       AppContext      Application context.
 * @var $vm        object          The view model object.
 * @var $uri       SystemUri       System Uri information.
 * @var $chronos   ChronosService  The chronos datetime service.
 * @var $nav       Navigator       Navigator object to build route.
 * @var $asset     AssetService    The Asset manage service.
 * @var $lang      LangService     The language translation service.
 */

declare(strict_types=1);

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

// src/Module/Admin/Article/views/article-edit.blade.php

/**
 * @var \App\Entity\Article   $item
 * @var \Windwalker\Form\Form $form
 */

$form->setRenderer(new \Windwalker\Form\Renderer\SimpleRenderer());
?>

@extends('global.body')

@section('content')
    <div class="container my-5">
        <form id="admin-form" action="{{ $nav->to('article_edit') }}" method="post">
            <div class="row">
                <div class="col-lg-8">
                    {!! $form->renderFields(); !!}

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
