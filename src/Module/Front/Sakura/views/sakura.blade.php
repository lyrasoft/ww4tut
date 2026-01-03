<?php

declare(strict_types=1);

namespace App\View;

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app       AppContext      Application context.
 * @var  $vm        SakuraView  The view model object.
 * @var $uri       SystemUri       System Uri information.
 * @var $chronos   ChronosService  The chronos datetime service.
 * @var $nav       Navigator       Navigator object to build route.
 * @var $asset     AssetService    The Asset manage service.
 * @var $lang      LangService     The language translation service.
 */

use App\Module\Front\Sakura\SakuraView;
use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

?>

@push('macro')
<style data-macro type="text/scss" data-scope=".view-sakura">
    h2 {
        color: $primary;
    }
</style>

<script data-macro="sakura" lang="ts" type="module">
    import { Modal } from 'bootstrap';

    console.log(Modal);
</script>
@endpush

@extends('global.body')

@section('content')
    <div class="container">
        <h2>{{ $title }}</h2>
    </div>
@stop
