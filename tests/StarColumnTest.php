<?php

use Filament\Support\Colors\Color;
use Filament\Support\Enums\IconSize;
use l3aro\FilamentRatingStar\Components\StarColumn;

it('can be instantiated', function () {
    $component = StarColumn::make('rating');
    expect($component)->toBeInstanceOf(StarColumn::class);
});

it('can be configured with stars', function () {
    $component = StarColumn::make('rating')->stars(10);
    expect($component->getStars())->toBe(10);
});

it('can be configured with color', function () {
    $component = StarColumn::make('rating')->color(Color::Red);
    expect($component->getColor())->toBe(Color::Red);
});

it('can be configured with icon size', function () {
    $component = StarColumn::make('rating')->iconSize(IconSize::Large);
    expect($component->getIconSize())->toBe(IconSize::Large->value);
});
