<?php

declare(strict_types=1);

namespace App\View;

/**
 * Global variables
 * --------------------------------------------------------------
 * @var  $app       AppContext      Application context.
 * @var  $vm        ArticleListView  The view model object.
 * @var  $uri       SystemUri       System Uri information.
 * @var  $chronos   ChronosService  The chronos datetime service.
 * @var  $nav       Navigator       Navigator object to build route.
 * @var  $asset     AssetService    The Asset manage service.
 * @var  $lang      LangService     The language translation service.
 */

use App\Enum\ItemState;
use App\Module\Admin\Article\ArticleListView;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;
use Windwalker\Form\Form;
use Windwalker\Form\Renderer\SimpleRenderer;

/**
 * @var \App\Entity\Article[] $items
 * @var Form                  $form
 */

$form->setRenderer(new SimpleRenderer());
?>

@push('macro')
    <style data-macro type="text/scss" data-scope=".view-article-list">
    </style>

    <script data-macro="article.list" lang="ts" type="module">
</script>
@endpush

@extends('global.body')

@section('content')
    <div class="container">

        <form id="admin-form" action="{{ $nav->self() }}" method="get">
            <div class="d-flex gap-3 mb-5">
                {!! $form->renderField('q') !!}
                {!! $form->renderField('state') !!}

                {{-- 加上一個隱藏的 submit 按鈕，才能用 enter 送出搜尋 --}}
                <button type="submit" style="display: none"></button>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width: 5%">Image</th>
                    <th>Title</th>
                    <th style="width: 10%">State</th>
                    <th style="width: 5%">Delete</th>
                    <th style="width: 5%" class="text-end">ID</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>
                            <img style="height: 30px" src="{{ $item->image }}" alt="image">
                        </td>
                        <td>
                            <a href="{{ $nav->to('article_edit')->id($item->id) }}">
                                {{ $item->title }}
                            </a>
                        </td>
                        <td>
                            <div class="text-{{ $item->state->getColor() }}">
                                <i class="{{ $item->state->getIcon() }}"></i>
                                {{ $item->state->getTitle() }}
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-danger">
                                Delete
                            </button>
                        </td>
                        <td class="text-end">
                            {{ $item->id }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="my-4">
                <x-pagination :pagination="$pagination"></x-pagination>
            </div>
        </form>
    </div>
@stop
