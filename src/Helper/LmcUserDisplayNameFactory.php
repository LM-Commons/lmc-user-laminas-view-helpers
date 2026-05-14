<?php

declare(strict_types=1);

namespace Lmc\User\Mezzio\View\Helper;

use Laminas\Authentication\AuthenticationService;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

final class LmcUserDisplayNameFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): LmcUserDisplayName
    {
        /** @psalm-suppress MixedArgument */
        return new LmcUserDisplayName(
            $container->get(AuthenticationService::class)
        );
    }
}
