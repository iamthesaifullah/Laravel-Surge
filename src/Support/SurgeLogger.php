<?php

namespace Surge\Support;

/**
 * Class SurgeLogger
 *
 * Simple logging for Surge.
 */
class SurgeLogger
{
    /**
     * Log an info message to the Surge log file.
     *
     * @param string $message
     * @return void
     */
    public static function info(string $message): void
    {
        self::write('info', $message);
    }

    /**
     * Log an error message to the Surge log file.
     *
     * @param string $message
     * @return void
     */
    public static function error(string $message): void
    {
        self::write('error', $message);
    }

    /**
     * Write a log message to the Surge log file.
     *
     * @param string $level
     * @param string $message
     * @return void
     */
    protected static function write(string $level, string $message): void
    {
        $logFile = config('surge.log_file', storage_path('logs/surge.log'));
        $timestamp = date('Y-m-d H:i:s');
        $line = sprintf("[%s] %s: %s%s", strtoupper($level), $timestamp, $message, PHP_EOL);
        @file_put_contents($logFile, $line, FILE_APPEND);
    }
}
