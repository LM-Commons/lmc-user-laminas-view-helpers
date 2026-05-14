<?php

declare(strict_types=1);

namespace Lmc\User\Mezzio\View\Helper;

use Laminas\Authentication\AuthenticationService;
use Lmc\User\Mezzio\View\Exception\InvalidConfigurationException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

final class LmcUserIdentityFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws InvalidConfigurationException
     */
    public function __invoke(ContainerInterface $container): LmcUserIdentity
    {
        /** @var AuthenticationService|null $authenticationService */
        $authenticationService = $container->has(AuthenticationService::class)
            ? $container->get(AuthenticationService::class)
            : null;

        if (null === $authenticationService) {
            throw new InvalidConfigurationException('The Authentication Service is not configured.');
        }

        return new LmcUserIdentity($authenticationService);
    }
}
