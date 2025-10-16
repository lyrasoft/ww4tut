<?php

declare(strict_types=1);

namespace App\View;

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app       AppContext      Application context.
 * @var  $vm        ArticleListView  The view model object.
 * @var $uri       SystemUri       System Uri information.
 * @var $chronos   ChronosService  The chronos datetime service.
 * @var $nav       Navigator       Navigator object to build route.
 * @var $asset     AssetService    The Asset manage service.
 * @var $lang      LangService     The language translation service.
 */

use App\Module\Front\Article\ArticleListView;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

/**
 * 用註解宣告 $items 的型別
 * @var \App\Entity\Article[] $items
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
                                {{ $item->getTitle() }}
                            </h2>

                            <div class="mb-2 small text-muted">
                                {{-- 這邊將 DB UTC 時區轉成本地時區 --}}
                                {{ $chronos->toLocalFormat($item->getCreated(), 'Y/m/d H:i:s') }}
                            </div>

                            <div>
                                {{-- 這邊截斷字串做摘要 --}}
                                {!! \Windwalker\str($item->getContent())->stripHtmlTags()->truncate(100, '...') !!}
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="my-4">
                    <x-pagination :pagination="$pagination"></x-pagination>
                </div>

            </div>
        </div>
    </div>
@stop
