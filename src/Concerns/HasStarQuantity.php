<?php

namespace l3aro\FilamentRatingStar\Concerns;

use Closure;
use Filament\Support\Enums\ArgumentValue;

trait HasStarQuantity
{
    protected Closure|ArgumentValue|int|null $star = ArgumentValue::Default;

    protected Closure|ArgumentValue|bool|null $allowZero = ArgumentValue::Default;

    public function getStar(): int
    {
        $star = $this->evaluate($this->star);

        if ($star instanceof ArgumentValue) {
            return 5;
        }

        return $star ?? 5;
    }

    public function getStarArray(): array
    {
        return range(1, $this->getStar());
    }

    public function star(Closure|int $star): static
    {
        $this->star = $star;

        return $this;
    }

    public function allowZero(Closure|bool $allowZero = true): static
    {
        $this->allowZero = $allowZero;

        return $this;
    }

    public function shouldAllowZero(): bool
    {
        $allowZero = $this->evaluate($this->allowZero);

        if ($allowZero instanceof ArgumentValue) {
            return false;
        }

        return $allowZero ?? false;
    }
}
