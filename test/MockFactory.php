<?php
namespace ScriptFUSIONTest;

use Mockery\MockInterface;
use ScriptFUSION\Porter\Connector\Connector;
use ScriptFUSION\Porter\Provider\Provider;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;
use ScriptFUSION\StaticClass;

final class MockFactory
{
    use StaticClass;

    /**
     * @return Provider|MockInterface
     */
    public static function mockProvider()
    {
        return \Mockery::namedMock(uniqid(Provider::class, false), Provider::class)
            ->shouldReceive('getConnector')
                ->andReturn(\Mockery::mock(Connector::class))
                ->byDefault()
            ->getMock()
        ;
    }

    /**
     * @param Provider $provider
     * @param \Iterator $return
     *
     * @return ProviderResource|MockInterface
     */
    public static function mockResource(Provider $provider, \Iterator $return = null)
    {
        $resource = \Mockery::mock(ProviderResource::class)
            ->shouldReceive('getProviderClassName')
                ->andReturn(get_class($provider))
            ->shouldReceive('fetch')
                ->andReturnUsing(function () {
                    yield 'foo';
                })
                ->byDefault()
            ->getMock()
        ;

        if ($return !== null) {
            $resource->shouldReceive('fetch')->andReturn($return);
        }

        return $resource;
    }
}
