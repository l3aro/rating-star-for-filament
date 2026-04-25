<?php

namespace l3aro\FilamentRatingStar;

use Filament\Support\Assets\Asset;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use l3aro\FilamentRatingStar\Testing\TestsFilamentRatingStar;

class FilamentRatingStarServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-rating-star';

    public static string $viewNamespace = 'filament-rating-star';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasInstallCommand(function (InstallCommand $command): void {
                $command
                    ->publishConfigFile()
                    ->askToStarRepoOnGitHub('l3aro/filament-rating-star');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath(sprintf('/../config/%s.php', $configFileName)))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName(),
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName(),
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path('stubs/filament-rating-star/' . $file->getFilename()),
                ], 'filament-rating-star-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsFilamentRatingStar());
    }

    protected function getAssetPackageName(): ?string
    {
        return 'l3aro/filament-rating-star';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('filament-rating-star', __DIR__ . '/../resources/dist/components/filament-rating-star.js'),
            // Css::make('filament-rating-star-styles', __DIR__ . '/../resources/dist/filament-rating-star.css'),
            // Js::make('filament-rating-star-scripts', __DIR__ . '/../resources/dist/filament-rating-star.js'),
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }
}
