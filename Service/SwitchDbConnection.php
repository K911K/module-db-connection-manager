<?php

declare(strict_types=1);

namespace K911K\DbConnectionManager\Service;

/**
 * Switch Db Connection.
 * @phpcs:ignoreFile
 */
class SwitchDbConnection
{
    /** @var string|null */
    private static $currentConnection;

    /**
     * Get the current database connection.
     *
     * @return string|null
     */
    public static function getCurrentConnection(): ?string
    {
        return self::$currentConnection;
    }

    /**
     * Switch the connection.
     *
     * @param string $dbConnection
     *
     * @return void
     */
    public static function switch(string $dbConnection): void
    {
        self::$currentConnection = $dbConnection;
    }
}