<?php

namespace l3aro\FilamentRatingStar\Concerns;

use Filament\Support\Enums\IconSize;

trait HasStarStyle
{
    public function getColor(): array
    {
        return $this->evaluate($this->color) ?? config('filament-rating-star.color');
    }

    public function getIconSize(): string
    {
        $size = $this->evaluate($this->iconSize);

        $size ??= config('filament-rating-star.icon_size');

        if ($size instanceof IconSize) {
            return $size->value;
        }

        return $size;
    }
}
