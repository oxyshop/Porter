<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Unit\Options;

use PHPUnit\Framework\TestCase;
use ScriptFUSIONTest\Stubs\TestOptions;

/**
 * @see TestOptions
 */
final class EncapsulatedOptionsTest extends TestCase
{
    /**
     * @var TestOptions
     */
    private $options;

    protected function setUp(): void
    {
        $this->options = new TestOptions;
    }

    public function testGet(): void
    {
        self::assertSame('foo', $this->options->getFoo());
    }

    public function testSet(): void
    {
        self::assertSame($this->options, $this->options->setFoo('bar'));

        self::assertSame('bar', $this->options->getFoo());
    }

    public function testSetNullOverridesDefault(): void
    {
        $this->options->setFoo(null);

        self::assertNull($this->options->getFoo());
    }

    public function testCopy(): void
    {
        self::assertSame(['foo' => 'foo'], $this->options->copy());

        $this->options->setFoo('bar');

        self::assertSame(['foo' => 'bar'], $this->options->copy());
    }

    public function testGetReference(): void
    {
        $this->options->setFoo(['bar' => 'bar', 'baz' => 'baz']);

        $this->options->removeFooKey('bar');

        self::assertSame(['baz' => 'baz'], $this->options->getFoo());
    }

    /**
     * Tests that getting a value that is neither set nor has a default defined returns null.
     */
    public function testGetUnset(): void
    {
        self::assertNull($this->options->getBar());
    }
}