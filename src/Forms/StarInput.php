<?php

namespace l3aro\FilamentRatingStar\Forms;

use Filament\Forms\Components\Concerns\CanBeLengthConstrained;
use Filament\Forms\Components\Concerns\CanBeReadOnly;
use Filament\Forms\Components\Field;
use Filament\Support\Colors\Color;
use Filament\Support\Concerns\HasColor;
use Filament\Support\Concerns\HasIconSize;
use Filament\Support\Enums\IconSize;
use l3aro\FilamentRatingStar\Concerns\HasStarQuantity;
use l3aro\FilamentRatingStar\Concerns\HasStarType;

class StarInput extends Field
{
    use CanBeLengthConstrained;
    use CanBeReadOnly;
    use HasColor;
    use HasIconSize;
    use HasStarQuantity;
    use HasStarType;

    public function getColor(): array
    {
        return $this->evaluate($this->color) ?? Color::Amber;
    }

    public function getIconSize(): string
    {
        $size = $this->evaluate($this->iconSize);

        if ($size instanceof IconSize) {
            return $size->value;
        }

        return $size ?? IconSize::Medium->value;
    }

    public function getView(): string
    {
        return 'filament-rating-star::forms.' . $this->getStarViewPrefix() . 'input';
    }
}
