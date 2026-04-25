<?php

declare(strict_types=1);

namespace l3aro\FilamentRatingStar\Components;

use Filament\Infolists\Components\Entry;
use Filament\Support\Concerns\HasColor;
use Filament\Support\Concerns\HasIconSize;
use l3aro\FilamentRatingStar\Concerns\HasStarQuantity;
use l3aro\FilamentRatingStar\Concerns\HasStarStyle;
use l3aro\FilamentRatingStar\Concerns\HasStarType;

class StarEntry extends Entry
{
    use HasColor;
    use HasIconSize;
    use HasStarQuantity;
    use HasStarStyle {
        HasStarStyle::getColor insteadof HasColor;
        HasStarStyle::getIconSize insteadof HasIconSize;
    }
    use HasStarType;

    protected string $view = 'filament-rating-star::wrappers.entry';

    public function getComponentView(): string
    {
        return 'filament-rating-star::components.star-static';
    }
}
