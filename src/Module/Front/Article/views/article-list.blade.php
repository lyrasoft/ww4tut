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

/**
 * 用註解宣告 $items 的型別
 * @var \App\Entity\Article[] $items
 */
?>

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

                            {{-- 加下面這段 --}}
                            <div class="mt-2">
                                <a class="btn btn-primary"
                                    href="{{ $nav->to('article_item', ['id' => $item->getId()]) }}">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="my-4">
                    {!! $pagination->render() !!}
                </div>

            </div>
        </div>
    </div>
@stop
