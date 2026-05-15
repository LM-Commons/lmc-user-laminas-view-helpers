<?php

declare(strict_types=1);

namespace Lmc\User\Mezzio\View;

use Lmc\User\Mezzio\View\Options\Options;
use Lmc\User\Mezzio\View\Options\OptionsFactory;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'view_helpers' => $this->getViewHelperConfig(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'factories' => [
                Options::class => OptionsFactory::class,
            ],
        ];
    }

    public function getViewHelperConfig(): array
    {
        return [
            'aliases'   => [
                'lmcUserDisplayName' => Helper\LmcUserDisplayName::class,
                'lmcUserIdentity'    => Helper\LmcUserIdentity::class,
                'lmcUserLoginWidget' => Helper\LmcUserLoginWidget::class,
            ],
            'factories' => [
                Helper\LmcUserDisplayName::class => Helper\LmcUserDisplayNameFactory::class,
                Helper\LmcUserIdentity::class    => Helper\LmcUserIdentityFactory::class,
                Helper\LmcUserLoginWidget::class => Helper\LmcUserLoginWidgetFactory::class,
            ],
        ];
    }

    public function getTemplates(): array
    {
        return [
            'paths' => [
                'lmcuser-view' => [__DIR__ . '/../templates/lmcuser-view'],
            ],
        ];
    }
}
