<?php

declare(strict_types=1);

namespace l3aro\FilamentRatingStar\Commands;

use Illuminate\Console\Command;

class FilamentRatingStarCommand extends Command
{
    public $signature = 'filament-rating-star';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
