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
        'xs' => 'w-2 h-2',
        'sm' => 'w-4 h-4',
        'md' => 'w-6 h-6',
        'lg' => 'w-8 h-8',
        'xl' => 'w-10 h-10',
    };
    $halfSizeClass = match ($size) {
        'xs' => 'w-1 h-2',
        'sm' => 'w-2 h-4',
        'md' => 'w-3 h-6',
        'lg' => 'w-4 h-8',
        'xl' => 'w-5 h-10',
    };
@endphp

<div
    x-data="{
        rating: {{ $getState() ?? 0 }},
        hoverRating: {{ $getState() ?? 0 }},
        allowHalfStar: true,
        allowZero: @js($shouldAllowZero()),
        rate(amount) {
            if (this.allowZero && this.rating == amount) {
                this.rating = 0;
            } else {
                this.rating = amount;
            }
        },
        resetPreview() {
            this.hoverRating = this.rating;
        }
    }"
    class="flex group"
>
    <input
        type="hidden"
        {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
        x-model="rating"
    >

    @foreach ($getStarArray() as $value)
        <input
            type="radio"
            value="{{ $value - 0.5 }}"
            id="{{ $id }}-star-{{ $value - 0.5 }}"
            class="sr-only peer"
            wire:loading.attr="disabled"
            @disabled($isDisabled)
        >

        <button
            type="button"
            @click="rate({{ $value - 0.5 }}); document.getElementById('{{ $id }}-star-{{ $value - 0.5 }}').checked = true; $wire.set('{{ $getStatePath() }}', rating)"
            @mouseover="hoverRating = {{ $value - 0.5 }}"
            @mouseleave="resetPreview()"
            :disabled="{{ $isDisabled ? 'true' : 'false' }}"
            wire:loading.attr="disabled"
            @class([
                "shrink-0 relative {$halfSizeClass} overflow-hidden cursor-pointer" => ! $isDisabled,
                "shrink-0 relative {$halfSizeClass} overflow-hidden cursor-not-allowed" => $isDisabled,
            ])
            :class="{
                'text-slate-300': hoverRating < {{ $value - 0.5 }} && rating < {{ $value - 0.5 }},
                '{{ $groupHoverColorClass }}': hoverRating >= {{ $value - 0.5 }} && rating < {{ $value - 0.5 }},
                '{{ $colorClass }}': rating >= {{ $value - 0.5 }},
            }"
            @style([
                \Filament\Support\get_color_css_variables($color, [500]) => $color !== 'gray',
            ])
        >
            <x-icon name="heroicon-s-star" class="absolute start-0 top-0 {{ $sizeClass }} pointer-events-none" />
        </button>

        <input
            type="radio"
            value="{{ $value }}"
            id="{{ $id }}-star-{{ $value }}"
            class="sr-only peer"
            wire:loading.attr="disabled"
            @disabled($isDisabled)
        >

        <button
            type="button"
            @click="rate({{ $value }}); document.getElementById('{{ $id }}-star-{{ $value }}').checked = true; $wire.set('{{ $getStatePath() }}', rating)"
            @mouseover="hoverRating = {{ $value }}"
            @mouseleave="resetPreview()"
            :disabled="{{ $isDisabled ? 'true' : 'false' }}"
            wire:loading.attr="disabled"
            @class([
                "shrink-0 relative {$halfSizeClass} overflow-hidden cursor-pointer" => ! $isDisabled,
                "shrink-0 relative {$halfSizeClass} overflow-hidden cursor-not-allowed" => $isDisabled,
            ])
            :class="{
                'text-slate-300': hoverRating < {{ $value }} && rating < {{ $value }},
                '{{ $groupHoverColorClass }}': hoverRating >= {{ $value }} && rating < {{ $value }},
                '{{ $colorClass }}': rating >= {{ $value }},
            }"
            @style([
                \Filament\Support\get_color_css_variables($color, [500]) => $color !== 'gray',
            ])
        >
            <x-icon name="heroicon-s-star" class="absolute end-0 top-0 {{ $sizeClass }} pointer-events-none" />
        </button>
    @endforeach
</div>
