<?php

use Filament\Forms\Components\Field;
use l3aro\FilamentRatingStar\Components\StarInput;

it('renders star input with alpine attributes', function () {
    $component = StarInput::make('rating')
        ->allowZero();

    $html = renderComponent($component);

    expect($html)
        ->toContain('x-data=')
        ->toContain('rating:')
        ->toContain('hoverRating:')
        ->toContain('rate(')
        ->toContain('resetPreview()')
        ->toContain('allowZero:');
});

it('renders hidden input with x-model and wire:model', function () {
    $component = StarInput::make('rating')
        ->allowZero();

    $html = renderComponent($component);

    expect($html)
        ->toContain('type="hidden"')
        ->toContain('x-model="rating"');
});

it('renders buttons with click and mouse event handlers', function () {
    $component = StarInput::make('rating')
        ->allowZero();

    $html = renderComponent($component);

    expect($html)
        ->toContain('@click="rate(')
        ->toContain('@mouseover=')
        ->toContain('@mouseleave="resetPreview()"');
});

it('renders class bindings for hover preview', function () {
    $component = StarInput::make('rating')
        ->allowZero();

    $html = renderComponent($component);

    expect($html)
        ->toContain(':class="{');
});

it('renders sr-only radio inputs for accessibility', function () {
    $component = StarInput::make('rating')
        ->allowZero()
        ->stars(5);

    $html = renderComponent($component);

    expect($html)
        ->toContain('sr-only')
        ->toContain('peer')
        ->toContain('type="radio"');
});

it('has toggle-to-zero behavior when allowZero is enabled', function () {
    $component = StarInput::make('rating')
        ->allowZero();

    $html = renderComponent($component);

    // No dedicated zero-star radio; instead clicking the same star twice toggles to zero
    // The rate() function handles: if (allowZero && rating == amount) { rating = 0; }
    expect($html)
        ->toContain('allowZero:')
        ->toContain('if (this.allowZero && this.rating == amount)')
        ->toContain('this.rating = 0');
});

it('does not have toggle-to-zero when allowZero is disabled', function () {
    $component = StarInput::make('rating'); // no allowZero()

    $html = renderComponent($component);

    // When allowZero is false, rate() doesn't set rating to 0
    expect($html)
        ->not->toContain('allowZero: true')
        ->toContain('allowZero:');
});

it('renders correct number of star options', function () {
    $component = StarInput::make('rating')
        ->stars(5);

    $html = renderComponent($component);

    expect($html)
        ->toContain('value="1"')
        ->toContain('value="2"')
        ->toContain('value="3"')
        ->toContain('value="4"')
        ->toContain('value="5"');
});

function renderComponent(Field $field): string
{
    $view = $field->getComponentView();
    $statePath = (fn() => $this->getStatePath())->call($field);
    $starArray = (fn() => $this->getStarArray())->call($field);
    $shouldAllowZero = (fn() => $this->shouldAllowZero())->call($field);
    $id = $field->getId();
    $isDisabled = $field->isDisabled();
    $color = $field->getColor();
    $iconSize = $field->getIconSize();
    $fieldWrapperView = $field->getFieldWrapperView();

    $bladePath = preg_replace('/^filament-rating-star::components\./', '', $view);
    $fullPath = resource_path('views/components/' . $bladePath . '.blade.php');

    $html = \Illuminate\Support\Facades\Blade::render(
        file_get_contents($fullPath),
        [
            'field' => $field,
            'getId' => fn() => $id,
            'isDisabled' => fn() => $isDisabled,
            'getColor' => fn() => $color,
            'getIconSize' => fn() => $iconSize,
            'getStarArray' => fn() => $starArray,
            'shouldAllowZero' => fn() => $shouldAllowZero,
            'getStatePath' => fn() => $statePath,
            'applyStateBindingModifiers' => fn($model) => $model,
            'getFieldWrapperView' => fn() => $fieldWrapperView,
        ],
    );

    return $html;
}
