<?php

namespace Surge\Async;

use Illuminate\Support\Facades\Bus;
use Surge\Support\SurgeLogger;

/**
 * Class AsyncDispatcher
 *
 * Provides methods to dispatch tasks asynchronously.
 */
class AsyncDispatcher
{
    /**
     * Dispatch a job class asynchronously.
     *
     * @param string $jobClass Fully qualified job class name.
     * @param array  $args     Arguments to pass to the job constructor.
     */
    public static function dispatch(string $jobClass, array $args = []): void
    {
        try {
            SurgeLogger::info("Dispatching job: $jobClass");
            if (class_exists($jobClass)) {
                // Use Laravel's queue system to dispatch the job
                Bus::dispatch(new $jobClass(...$args));
            } else {
                throw new \Exception("Job class $jobClass does not exist.");
            }
        } catch (\Exception $e) {
            SurgeLogger::error('Failed to dispatch job: ' . $e->getMessage());
        }
    }
}
