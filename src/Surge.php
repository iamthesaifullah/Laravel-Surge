<?php

namespace Surge;

use Surge\Async\AsyncDispatcher;
use Surge\Async\WorkerManager;

/**
 * Main Surge service class.
 */
class Surge
{
    /**
     * Dispatch a job for asynchronous execution.
     *
     * @param string $jobClass
     * @param array  $args
     * @return void
     */
    public function dispatch(string $jobClass, array $args = []): void
    {
        AsyncDispatcher::dispatch($jobClass, $args);
    }

    /**
     * Start Surge worker processes.
     *
     * @param int|null $workers
     * @return void
     */
    public function start(int $workers = null): void
    {
        WorkerManager::start($workers);
    }

    /**
     * Stop all Surge worker processes.
     *
     * @return void
     */
    public function stop(): void
    {
        WorkerManager::stop();
    }

    /**
     * Restart Surge worker processes.
     *
     * @param int|null $workers
     * @return void
     */
    public function restart(int $workers = null): void
    {
        WorkerManager::restart($workers);
    }

    /**
     * Check the status of Surge workers.
     *
     * @return array
     */
    public function status(): array
    {
        return WorkerManager::status();
    }
}
