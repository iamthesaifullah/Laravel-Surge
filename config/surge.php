<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Surge Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the settings for the Surge package.
    |
    */

    // Number of worker processes to launch for async jobs
    'workers' => env('SURGE_WORKERS', 1),

    // Queue connection for the workers
    'connection' => env('SURGE_CONNECTION', null),

    // Queue name (for Laravel queues)
    'queue' => env('SURGE_QUEUE', 'default'),

    // Sleep time (seconds) between queue work loops
    'sleep' => env('SURGE_SLEEP', 3),

    // Max execution time (seconds) for a job
    'timeout' => env('SURGE_TIMEOUT', 60),

    // Max attempts for a job
    'max_tries' => env('SURGE_MAX_TRIES', 3),

    // Path to Surge log file
    'log_file' => env('SURGE_LOG_FILE', storage_path('logs/surge.log')),

    // Path to PID file for storing worker process IDs
    'pid_file' => env('SURGE_PID_FILE', storage_path('surge.pid')),
];
