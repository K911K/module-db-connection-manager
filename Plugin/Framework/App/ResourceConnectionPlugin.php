<?php

declare(strict_types=1);

namespace K911K\DbConnectionManager\Plugin\Framework\App;

use K911K\DbConnectionManager\Service\SwitchDbConnection;

/**
 * Resource connection plugin.
 */
class ResourceConnectionPlugin
{
    /**
     * Before get connection by name plugin.
     *
     * @return string[]|null
     */
    public function beforeGetConnectionByName(): ?array
    {
        if (SwitchDbConnection::getCurrentConnection()) {
            return [SwitchDbConnection::getCurrentConnection()];
        }

        return null;
    }
}