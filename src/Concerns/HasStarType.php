<?php

namespace l3aro\FilamentRatingStar\Concerns;

use Closure;
use Filament\Support\Enums\ArgumentValue;

trait HasStarType
{
    protected Closure|ArgumentValue|bool|null $allowHalfStar = ArgumentValue::Default;

    public function shouldAllowHalfStar(): bool
    {
        $allowHalfStar = $this->evaluate($this->allowHalfStar);

        if ($allowHalfStar instanceof ArgumentValue) {
            return (bool) config('filament-rating-star.allow_half_star');
        }

        return (bool) $allowHalfStar;
    }

    protected function getStarViewPrefix(): string
    {
        return $this->shouldAllowHalfStar() ? 'star-half-' : 'star-full-';
    }

    public function allowHalfStar(bool|Closure $allowHalfStar = true): static
    {
        $this->allowHalfStar = $allowHalfStar;

        return $this;
    }
}
