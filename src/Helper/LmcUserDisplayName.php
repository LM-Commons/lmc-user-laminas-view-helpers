<?php

declare(strict_types=1);

namespace Lmc\User\Mezzio\View\Helper;

use Laminas\Authentication\AuthenticationServiceInterface;
use Laminas\View\Helper\HelperInterface;
use Laminas\View\Renderer\RendererInterface;
use Lmc\User\Mezzio\View\Exception\DomainException;
use Lmc\User\Repository\UserInterface;
use Override;

use function strpos;
use function substr;

final class LmcUserDisplayName implements HelperInterface
{
    public function __construct(
        protected AuthenticationServiceInterface $authService,
    ) {
    }

    public function __invoke(?UserInterface $user = null): string|bool
    {
        if (null === $user) {
            if ($this->authService->hasIdentity()) {
                /** @psalm-suppress MixedAssignment */
                $user = $this->authService->getIdentity();
                if (! $user instanceof UserInterface) {
                    throw new DomainException(
                        '$user is not an instance of Lmc\User\Repository\UserInterface'
                    );
                }
            } else {
                return false;
            }
        }
        $displayName = $user->getDisplayName();
        if (null === $displayName) {
            $displayName = $user->getUsername();
        }
        if (null === $displayName) {
            /** @var string $displayName */
            $displayName = $user->getEmail();

            /** @psalm-suppress  PossiblyFalseArgument*/
            $displayName = substr($displayName, 0, strpos($displayName, '@'));
        }

        return $displayName;
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
