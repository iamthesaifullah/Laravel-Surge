<?php

namespace Surge\Console;

use Illuminate\Console\Command;
use Surge\Facades\Surge;

/**
 * Class StopSurge
 *
 * Artisan command to stop Surge workers.
 */
class StopSurge extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'surge:stop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stop all Surge background worker processes';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        Surge::stop();
        $this->info('Surge stopped.');
    }
}
