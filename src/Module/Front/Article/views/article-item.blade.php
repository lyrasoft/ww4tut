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
 * @var \App\Entity\Article $item
 */
?>

@extends('global.body')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">

                {{-- 加這裡 --}}
                <aside class="my-2">
                    <a class="btn btn-sm btn-outline-secondary"
                        href="{{ $nav->back() ?? $nav->to('article_list') }}">
                        Back
                    </a>
                </aside>

                <article class="c-article">
                    <header>
                        <h2>{{ $item->getTitle() }}</h2>
                    </header>

                    <div class="my-2 text-muted">
                        {{ $chronos->toLocalFormat($item->getCreated(), 'Y/m/d H:i:s') }}
                    </div>

                    <div class="c-article__content">
                        {!! $item->getContent() !!}
                    </div>
                </article>
            </div>
        </div>
    </div>
@stop
