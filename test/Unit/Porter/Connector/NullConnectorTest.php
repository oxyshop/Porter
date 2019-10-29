<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Unit\Porter\Connector;

use PHPUnit\Framework\TestCase;
use ScriptFUSION\Porter\Connector\NullConnector;

/**
 * @see NullConnector
 */
final class NullConnectorTest extends TestCase
{
    public function test(): void
    {
        self::assertNull((new NullConnector)->fetch('foo'));
    }
}
