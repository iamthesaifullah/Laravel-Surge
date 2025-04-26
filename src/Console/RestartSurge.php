<?php

namespace Surge\Console;

use Illuminate\Console\Command;
use Surge\Facades\Surge;

/**
 * Class RestartSurge
 *
 * Artisan command to restart Surge workers.
 */
class RestartSurge extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'surge:restart {workers?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restart Surge background worker processes';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $workers = $this->argument('workers') ? (int)$this->argument('workers') : null;
        Surge::restart($workers);
        $count = $workers ?? config('surge.workers');
        $this->info("Surge restarted with {$count} worker(s).");
    }
}
