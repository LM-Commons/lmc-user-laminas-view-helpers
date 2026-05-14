<?php

declare(strict_types=1);

namespace Lmc\User\Mezzio\View\Helper;

use Laminas\Authentication\AuthenticationServiceInterface;
use Laminas\View\Helper\HelperInterface;
use Laminas\View\Renderer\RendererInterface;
use Lmc\User\Repository\UserInterface;
use Override;

final class LmcUserIdentity implements HelperInterface
{
    public function __construct(
        protected AuthenticationServiceInterface $authenticationService
    ) {
    }

    public function __invoke(): UserInterface|bool
    {
        if ($this->authenticationService->hasIdentity()) {
            /** @psalm-suppress MixedReturnStatement */
            return $this->authenticationService->getIdentity();
        } else {
            return false;
        }
    }

    #[Override]
    public function getView(): RendererInterface|null
    {
        return null;
    }

    #[Override]
    public function setView(RendererInterface $view): self
    {
        return $this;
    }
}
