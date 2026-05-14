<?php

declare(strict_types=1);

namespace LmcTest\User\Mezzio\View\Options;

use Lmc\User\Mezzio\View\Exception\InvalidConfigurationException;
use Lmc\User\Mezzio\View\Options\Options;
use Lmc\User\Mezzio\View\Options\OptionsFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

final class OptionsFactoryTest extends TestCase
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testFactoryReturnsOptions(): void
    {
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())->method('get')
            ->with('config')
            ->willReturn([
                'lmc_user' => [],
            ]);
        $factory = new OptionsFactory();
        $options = $factory($container);
        $this->assertInstanceOf(Options::class, $options);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testFactoryInvalidConfig(): void
    {
        $container = $this->createMock(ContainerInterface::class);
        $container->expects($this->once())->method('get')
            ->with('config')
            ->willReturn([]);
        $factory = new OptionsFactory();
        $this->expectException(InvalidConfigurationException::class);
        $factory($container);
    }
}
