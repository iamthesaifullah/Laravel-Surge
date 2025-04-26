<?php

namespace Surge\Console;

use Illuminate\Console\Command;
use Surge\Facades\Surge;

/**
 * Class StartSurge
 *
 * Artisan command to start Surge workers.
 */
class StartSurge extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'surge:start {workers?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start Surge background worker processes';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $workers = $this->argument('workers') ? (int)$this->argument('workers') : null;
        Surge::start($workers);
        $count = $workers ?? config('surge.workers');
        $this->info("Surge started with {$count} worker(s).");
    }
}
