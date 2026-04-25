<?php

use Filament\Support\Colors\Color;
use Filament\Support\Enums\IconSize;
use l3aro\FilamentRatingStar\Components\StarEntry;

it('can be instantiated', function () {
    $component = StarEntry::make('rating');
    expect($component)->toBeInstanceOf(StarEntry::class);
});

it('can be configured with stars', function () {
    $component = StarEntry::make('rating')->stars(10);
    expect($component->getStars())->toBe(10);
});

it('can be configured with color', function () {
    $component = StarEntry::make('rating')->color(Color::Red);
    expect($component->getColor())->toBe(Color::Red);
});

it('can be configured with icon size', function () {
    $component = StarEntry::make('rating')->iconSize(IconSize::Large);
    expect($component->getIconSize())->toBe(IconSize::Large->value);
});