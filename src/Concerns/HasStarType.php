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
            return false;
        }

        return $allowHalfStar ?? false;
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
