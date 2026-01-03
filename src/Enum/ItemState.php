<?php

declare(strict_types=1);

namespace App\Enum;

use Windwalker\Utilities\Enum\EnumRichInterface;
use Windwalker\Utilities\Enum\EnumRichTrait;

enum ItemState: int implements EnumRichInterface
{
    use EnumRichTrait;

    case ENABLED = 1;
    case DISABLED = 0;

    protected function translateKey(string $name): string
    {
        return "app.enum.item.state.$name";
    }
}
