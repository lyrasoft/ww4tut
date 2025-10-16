<?php

declare(strict_types=1);

namespace App\Enum;

use Windwalker\Utilities\Attributes\Enum\Color;
use Windwalker\Utilities\Attributes\Enum\Icon;
use Windwalker\Utilities\Attributes\Enum\Title;
use Windwalker\Utilities\Enum\EnumRichInterface;
use Windwalker\Utilities\Enum\EnumRichTrait;

enum ItemState: int implements EnumRichInterface
{
    use EnumRichTrait;

    #[Title('啟用中')]
    #[Icon('fa-solid fa-check')]
    #[Color('success')]
    case ENABLED = 1;

    #[Title('已關閉')]
    #[Icon('fa-solid fa-xmark')]
    #[Color('danger')]
    case DISABLED = 0;

    protected function translateKey(string $name): string
    {
        return "app.enum.disabled.$name";
    }
}
