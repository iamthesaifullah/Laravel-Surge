<?php

namespace Surge\Console;

use Illuminate\Console\Command;
use Surge\Facades\Surge;

/**
 * Class StatusSurge
 *
 * Artisan command to display Surge status.
 */
class StatusSurge extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'surge:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show current Surge worker status';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $status = Surge::status();
        if ($status['running']) {
            $this->info('Surge is running (PIDs: ' . implode(', ', $status['pids']) . ').');
        } else {
            $this->info('Surge is not running.');
        }
    }
}
