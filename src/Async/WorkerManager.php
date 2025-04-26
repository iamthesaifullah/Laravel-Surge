<?php

namespace Surge\Async;

use Symfony\Component\Process\Process;
use Surge\Support\SurgeLogger;

/**
 * Class WorkerManager
 *
 * Manages background worker processes for Surge.
 */
class WorkerManager
{
    /**
     * Start the Surge workers.
     *
     * @param int|null $workers Number of worker processes to start (uses config if null).
     * @return void
     */
    public static function start(int $workers = null): void
    {
        $workers = $workers ?? config('surge.workers', 1);
        $pids = [];

        // Path to Artisan executable
        $artisan = base_path('artisan');

        for ($i = 0; $i < $workers; $i++) {
            try {
                // Build the command for the Laravel queue worker
                $connection = config('surge.connection', config('queue.default'));
                $queue = config('surge.queue', 'default');
                $sleep = config('surge.sleep', 3);
                $timeout = config('surge.timeout', 60);
                $maxTries = config('surge.max_tries', 3);

                $command = [
                    'php', $artisan,
                    'queue:work',
                    '--connection=' . $connection,
                    '--queue=' . $queue,
                    '--sleep=' . $sleep,
                    '--timeout=' . $timeout,
                    '--tries=' . $maxTries,
                    '--daemon',
                ];

                // Start process
                $process = new Process($command);
                $process->setTimeout(null);
                $process->start();

                $pid = $process->getPid();
                $pids[] = $pid;

                SurgeLogger::info("Started worker process with PID $pid");
            } catch (\Exception $e) {
                SurgeLogger::error('Failed to start worker: ' . $e->getMessage());
            }
        }

        // Save all process IDs to PID file
        if (!empty($pids)) {
            file_put_contents(config('surge.pid_file'), json_encode($pids));
        }
    }

    /**
     * Stop all Surge workers.
     *
     * @return void
     */
    public static function stop(): void
    {
        $pidFile = config('surge.pid_file');

        if (file_exists($pidFile)) {
            $pids = json_decode(file_get_contents($pidFile), true) ?: [];
        } else {
            $pids = [];
        }

        foreach ((array) $pids as $pid) {
            try {
                if (is_numeric($pid)) {
                    // Try to gracefully stop the process
                    if (function_exists('posix_kill')) {
                        posix_kill((int)$pid, SIGTERM);
                    } elseif (strncasecmp(PHP_OS, 'WIN', 3) === 0) {
                        // Windows: use taskkill
                        exec("taskkill /F /PID {$pid}");
                    }
                    SurgeLogger::info("Stopped worker process with PID {$pid}");
                }
            } catch (\Exception $e) {
                SurgeLogger::error('Failed to stop worker ' . $pid . ': ' . $e->getMessage());
            }
        }

        // Remove PID file
        if (file_exists($pidFile)) {
            unlink($pidFile);
        }
    }

    /**
     * Restart Surge workers.
     *
     * @param int|null $workers
     * @return void
     */
    public static function restart(int $workers = null): void
    {
        static::stop();
        static::start($workers);
    }

    /**
     * Check the status of Surge workers.
     *
     * @return array ['running' => bool, 'pids' => array]
     */
    public static function status(): array
    {
        $pidFile = config('surge.pid_file');
        $pids = [];

        if (file_exists($pidFile)) {
            $pids = json_decode(file_get_contents($pidFile), true) ?: [];
        }

        $runningPids = [];
        foreach ((array) $pids as $pid) {
            if (is_numeric($pid) && static::isRunning((int)$pid)) {
                $runningPids[] = (int)$pid;
            }
        }

        return [
            'running' => !empty($runningPids),
            'pids' => $runningPids,
        ];
    }

    /**
     * Determine if a process with given PID is running.
     *
     * @param int $pid
     * @return bool
     */
    protected static function isRunning(int $pid): bool
    {
        if (function_exists('posix_kill')) {
            return posix_kill($pid, 0);
        }
        return false;
    }
}
