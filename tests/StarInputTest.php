<?php

use Filament\Support\Colors\Color;
use Filament\Support\Enums\IconSize;
use l3aro\FilamentRatingStar\Components\StarInput;

it('can be instantiated', function () {
    $component = StarInput::make('rating');
    expect($component)->toBeInstanceOf(StarInput::class);
});

it('can be configured with stars', function () {
    $component = StarInput::make('rating')->stars(10);
    expect($component->getStars())->toBe(10);
});

it('can be configured with half stars', function () {
    $component = StarInput::make('rating')->allowHalfStar(true);
    expect($component->shouldAllowHalfStar())->toBe(true);
});

it('can be configured with zero', function () {
    $component = StarInput::make('rating')->allowZero(true);
    expect($component->shouldAllowZero())->toBe(true);
});

it('can be configured with color', function () {
    $component = StarInput::make('rating')->color(Color::Red);
    expect($component->getColor())->toBe(Color::Red);
});

it('can be configured with icon size', function () {
    $component = StarInput::make('rating')->iconSize(IconSize::Large);
    expect($component->getIconSize())->toBe(IconSize::Large->value);
});
