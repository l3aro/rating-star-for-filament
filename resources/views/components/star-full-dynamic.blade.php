@php
    $id = $getId();
    $isDisabled = $isDisabled();
    $color = $getColor();
    $colorClass = match ($color) {
        'gray' => 'text-gray-500 dark:text-gray-400',
        default => "text-custom-500",
    };
    $groupHoverColorClass = match ($color) {
        'gray' => 'group-hover:!text-gray-500 dark:group-hover:!text-gray-400',
        default => "group-hover:!text-custom-500",
    };
    $size = $getIconSize();
    $sizeClass = match ($size) {
        'xs' => 'w-3 h-3',
        'sm' => 'w-4 h-4',
        'md' => 'w-6 h-6',
        'lg' => 'w-8 h-8',
        'xl' => 'w-10 h-10',
    };
@endphp

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div class="flex group">
        @if ($shouldAllowZero())
            <input
                type="radio"
                value="0"
                id="{{ $id }}-star-0"
                class="!hidden peer"
                @disabled($isDisabled)
                {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
            >

            <label
                for="{{ $id }}-star-0"
                @class([
                    "text-slate-300 peer-checked:text-danger-500",
                    "group-hover:!text-slate-300 peer-hover:!text-danger-500 cursor-pointer" => ! $isDisabled,
                ])
            >
                <x-icon name="heroicon-c-no-symbol" class="{{ $sizeClass }} pointer-events-none" />
            </label>
        @endif

        @foreach ($getStarArray() as $value)
            <label
                for="{{ $id }}-star-{{ $value }}"
                @class([
                    "{$colorClass} peer-checked:text-slate-300",
                    "{$groupHoverColorClass} peer-hover:!text-slate-300 cursor-pointer" => ! $isDisabled,
                ])
                @style([
                    \Filament\Support\get_color_css_variables($color, [500]) => $color !== 'gray',
                ])
            >
                <x-icon name="heroicon-s-star" class="{{ $sizeClass }} pointer-events-none" />
            </label>

            <input
                type="radio"
                value="{{ $value }}"
                id="{{ $id }}-star-{{ $value }}"
                class="!hidden peer"
                wire:loading.attr="disabled"
                @disabled($isDisabled)
                {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
            >
        @endforeach
    </div>
</x-dynamic-component>