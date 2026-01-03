<?php

declare(strict_types=1);

namespace App\View;

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app       AppContext      Application context.
 * @var  $vm        ArticleEditView  The view model object.
 * @var $uri       SystemUri       System Uri information.
 * @var $chronos   ChronosService  The chronos datetime service.
 * @var $nav       Navigator       Navigator object to build route.
 * @var $asset     AssetService    The Asset manage service.
 * @var $lang      LangService     The language translation service.
 */

use App\Module\Admin\Article\ArticleEditView;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

// 目前的版本有一個小 bug，要先加上這一段才能正常顯示 form，之後會修復
$form->setRenderer(new \Windwalker\Form\Renderer\SimpleRenderer());
?>

@push('macro')
<style data-macro type="text/scss" data-scope=".view-article-edit">
</style>

<script data-macro="article.edit" lang="ts" type="module">
</script>
@endpush

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
