<?php

declare(strict_types=1);

namespace Lmc\User\Mezzio\View\Helper;

use Laminas\Form\FormInterface;
use Laminas\View\Renderer\PhpRenderer;
use Laminas\View\Renderer\RendererInterface;
use Lmc\User\Mezzio\View\Exception\InvalidConfigurationException;
use Lmc\User\Mezzio\View\Options\Options;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

final class LmcUserLoginWidgetFactory
{
    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    public function __invoke(ContainerInterface $container): LmcUserLoginWidget
    {
        /** @var Options $options */
        $options = $container->get(Options::class);

        /** @var FormInterface|null $form */
        $form = $container->has('lmcuser_login_form') ? $container->get('lmcuser_login_form') : null;
        if (null === $form) {
            throw new InvalidConfigurationException('Missing "lmcuser_login_form".');
        }

        /** @var RendererInterface|null $renderer */
        $renderer = $container->has(PhpRenderer::class) ? $container->get(PhpRenderer::class) : null;
        if (null === $renderer) {
            throw new InvalidConfigurationException('Missing PhpRenderer service.');
        }

        if (null === $options->getTemplate('login-widget')) {
            throw new InvalidConfigurationException('Template "login-widget" must be set.');
        }

        /** @psalm-suppress PossiblyNullArgument */
        return new LmcUserLoginWidget($form, $options->getTemplate('login-widget'), $renderer);
    }
}
