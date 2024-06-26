<?php

declare(strict_types=1);

namespace App\Module\Admin\Acme;

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewMetadata;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\Html\HtmlFrame;
use Windwalker\Core\View\View;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\DI\Attributes\Autowire;

/**
 * The AcmeView class.
 */
#[ViewModel(
    layout: 'acme',
    js: 'acme.js'
)]
class AcmeView implements ViewModelInterface
{
    /**
     * Constructor.
     */
    public function __construct(
        #[Autowire]
        protected AcmeRepository $repository
    ) {
        //
    }

    /**
     * Prepare View.
     *
     * @param    AppContext  $app   The web app context.
     * @param    View        $view  The view object.
     *
     * @return    mixed
     */
    public function prepare(AppContext $app, View $view): array
    {
        $items = $this->repository->getList();

        return compact('items');
    }


    #[ViewMetadata]
    public function prepareMetadata(HtmlFrame $htmlFrame): void
    {
        $htmlFrame->setTitle('Acme List');
    }
}
