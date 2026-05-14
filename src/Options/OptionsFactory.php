<?php

declare(strict_types=1);

namespace Lmc\User\Mezzio\View\Options;

use Laminas\Stdlib\AbstractOptions;
use Lmc\User\Mezzio\View\Exception\InvalidConfigurationException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

final class OptionsFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): Options
    {
        /** @var array<array-key, AbstractOptions<mixed>|iterable<string,mixed>|null> $config */
        $config = $container->get('config');
        if (! isset($config['lmc_user'])) {
            throw new InvalidConfigurationException('Could not find a config for LmcUser');
        }
        return new Options($config['lmc_user']);
    }
}
