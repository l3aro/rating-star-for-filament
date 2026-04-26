<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use l3aro\FilamentRatingStar\Components\StarInput;
use l3aro\FilamentRatingStar\Tests\Models\Star;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Schemas\Schema as FormSchema;
use Livewire\Component;
use Livewire\Livewire;

beforeEach(function () {
    if (! Schema::hasTable('stars')) {
        Schema::create('stars', function (Blueprint $table) {
            $table->id();
            $table->decimal('rating', 3, 1)->nullable();
            $table->timestamps();
        });
    }

    $cachePath = sys_get_temp_dir() . '/laravel-views-' . uniqid();
    @mkdir($cachePath, 0755, true);
    config(['view.compiled' => $cachePath]);

    $paths = config('view.paths', []);
    $paths[] = __DIR__ . '/views';
    config(['view.paths' => $paths]);

    $finder = app('view.finder');
    $finder->prependLocation(__DIR__ . '/views');
});

class TestStarInputForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $star;

    public function mount($star): void
    {
        $this->star = $star;
        $this->form->fill($this->star->toArray());
    }

    public function form(FormSchema $schema): FormSchema
    {
        return $schema
            ->components([
                StarInput::make('rating'),
            ])
            ->statePath('data')
            ->model($this->star ?? Star::class);
    }

    public function save(): void
    {
        $this->star->update($this->form->getState());
    }

    public function render()
    {
        return view('livewire.test-star-input-form');
    }
}

it('renders form with empty rating for new star', function () {
    $star = Star::create(['rating' => null]);

    Livewire::test(TestStarInputForm::class, ['star' => $star])
        ->assertSet('data.rating', null);
});

it('persists rating to database on form submission', function () {
    $star = Star::create(['rating' => null]);

    Livewire::test(TestStarInputForm::class, ['star' => $star])
        ->fillForm(['rating' => 4])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($star->fresh()->rating)->toBe(4.0);
});

it('re-populates saved rating value from database', function () {
    $star = Star::create(['rating' => 4]);

    Livewire::test(TestStarInputForm::class, ['star' => $star])
        ->assertSet('data.rating', 4.0)
        ->fillForm(['rating' => 3])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($star->fresh()->rating)->toBe(3.0);
});

it('persists half-star rating value', function () {
    $star = Star::create(['rating' => null]);

    Livewire::test(TestStarInputForm::class, ['star' => $star])
        ->fillForm(['rating' => 2.5])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($star->fresh()->rating)->toBe(2.5);
});

it('persists zero rating value', function () {
    $star = Star::create(['rating' => null]);

    Livewire::test(TestStarInputForm::class, ['star' => $star])
        ->fillForm(['rating' => 0])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($star->fresh()->rating)->toBe(0.0);
});
