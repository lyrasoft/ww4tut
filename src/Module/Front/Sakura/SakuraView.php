<?php

declare(strict_types=1);

namespace App\Module\Front\Sakura;

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Attributes\ViewPrepare;
use Windwalker\Core\View\View;

#[ViewModel(
    layout: 'sakura',
    js: 'sakura.js'
)]
class SakuraView
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        //
    }

    #[ViewPrepare]
    public function prepare(AppContext $app, View $view): array
    {
        $title = 'Sakura View';

        return compact('title');
    }
}
