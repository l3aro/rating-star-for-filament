# Rating star for filament table column and schemas.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/l3aro/rating-star-for-filament.svg?style=flat-square)](https://packagist.org/packages/l3aro/rating-star-for-filament)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/l3aro/rating-star-for-filament/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/l3aro/rating-star-for-filament/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/l3aro/rating-star-for-filament/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/l3aro/rating-star-for-filament/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/l3aro/rating-star-for-filament.svg?style=flat-square)](https://packagist.org/packages/l3aro/rating-star-for-filament)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require l3aro/rating-star-for-filament
```

> [!IMPORTANT]
> If you have not set up a custom theme and are using Filament Panels follow the instructions in the [Filament Docs](https://filamentphp.com/docs/4.x/styling/overview#creating-a-custom-theme) first.

After setting up a custom theme add the plugin's views to your theme css file or your app's css file if using the standalone packages.

```css
@source '../../../../vendor/l3aro/rating-star-for-filament/resources/**/*.blade.php';
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-rating-star-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-rating-star-views"
```

This is the contents of the published config file:
```php
use Filament\Support\Colors\Color;
use Filament\Support\Enums\IconSize;

return [
    'stars' => 5,
    'allow_half_star' => false,
    'allow_zero' => false,
    'color' => Color::Amber,
    'icon_size' => IconSize::Medium,
];
```

## Usage

### Form Field

Use `StarInput` in your form schema:

```php
use l3aro\FilamentRatingStar\Components\StarInput;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\IconSize;

StarInput::make('rating')
    ->stars(5)              // Number of stars (default: 5)
    ->allowHalfStar()       // Enable half-star selection (default: false)
    ->allowZero()           // Allow zero rating (default: false)
    ->color(Color::Amber)   // Star color (default: Amber)
    ->iconSize(IconSize::Medium); // Star size (default: Medium)
```

### Table Column

Use `StarColumn` in your table:

```php
use l3aro\FilamentRatingStar\Components\StarColumn;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\IconSize;

StarColumn::make('rating')
    ->stars(5)              // Number of stars to display (default: 5)
    ->color(Color::Amber)    // Star color (default: Amber)
    ->iconSize(IconSize::Medium); // Star size (default: Medium)
```

### Infolist Entry

Use `StarEntry` in your infolist:

```php
use l3aro\FilamentRatingStar\Components\StarEntry;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\IconSize;

StarEntry::make('rating')
    ->stars(5)              // Number of stars to display (default: 5)
    ->color(Color::Amber)    // Star color (default: Amber)
    ->iconSize(IconSize::Medium); // Star size (default: Medium)
```

### Register Plugin

Enable the plugin in your `PanelProvider`:

```php
use l3aro\FilamentRatingStar\FilamentRatingStarPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            FilamentRatingStarPlugin::make(),
        ]);
}

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [l3aro](https://github.com/l3aro)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
