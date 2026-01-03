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

use App\Entity\Article;
use App\Module\Front\Article\ArticleListView;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

/**
 * @var $items Article[]
 */
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
        <div class="row">
            <div class="col-lg-7">

                @foreach ($items as $item)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title">
                                {{ $item->title }}
                            </h2>

                            <div class="mb-2 small text-muted">
                                {{-- 這邊將 DB UTC 時區轉成本地時區 --}}
                                {{ $chronos->toLocalFormat($item->created, 'Y/m/d H:i:s') }}
                            </div>

                            <div>
                                {{-- 這邊截斷字串做摘要 --}}
                                {!! \Windwalker\str($item->content)->stripHtmlTags()->truncate(100, '...') !!}
                            </div>

                            <div class="mt-2">
                                <a class="btn btn-primary"
                                    href="{{ $nav->to('article_item', ['id' => $item->id]) }}">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="my-4">
                    <x-pagination :pagination="$pagination" />
                </div>
            </div>
        </div>
    </div>
@stop
