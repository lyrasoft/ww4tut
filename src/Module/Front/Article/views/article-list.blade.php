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
                                {{ $item->getCreated() }}
                            </div>

                            <div>
                                {!! $item->getIntrotext() !!}
                                {!! $item->getFulltext() !!}
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
