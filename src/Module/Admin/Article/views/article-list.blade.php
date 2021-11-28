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

// src/Module/Admin/Article/views/article-list.blade.php

/**
 * @var \App\Entity\Article[] $items
 * @var \Windwalker\Form\Form $form
 */

$form->setRenderer(new \Windwalker\Form\Renderer\SimpleRenderer());

?>

{{-- 這邊要修改成 admin.global.body --}}
@extends('admin.global.body')

@section('content')
    <form id="admin-form" action="{{ $nav->to('article_list') }}" method="get">

        <div class="d-flex">
            {!! $form->renderField('q') !!}
            {!! $form->renderField('state') !!}

            {{-- 加上一個隱藏的 submit 按鈕，才能用 enter 送出搜尋 --}}
            <button type="submit" style="display: none"></button>
        </div>

        <div class="my-2">
            <a href="{{ $nav->to('article_edit') }}" class="btn btn-primary btn-sm">
                New Item
            </a>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th style="width: 5%">Image</th>
                <th>Title</th>
                <th style="width: 5%">啟用</th>
                <th style="width: 5%">Delete</th>
                <th style="width: 5%" class="text-end">ID</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>
                        <img style="height: 30px" src="{{ $item->getImage() }}" alt="image">
                    </td>
                    <td>
                        <a href="{{ $nav->to('article_edit')->id($item->getId()) }}">
                            {{ $item->getTitle() }}
                        </a>
                    </td>
                    <td class="text-nowrap">
                        @if ($item->getState())
                            啟用中
                        @else
                            已關閉
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-danger"
                            onclick="deleteItem({{ $item->getId() }})">
                            Delete
                        </button>
                    </td>
                    <td class="text-end">
                        {{ $item->getId() }}
                    </td>
                </tr>
            @endforeach
            </tbody>

            <tfoot>
            <tr>
                <td colspan="20">
                    {!! $pagination->render() !!}
                </td>
            </tr>
            </tfoot>
        </table>

    </form>
@stop
