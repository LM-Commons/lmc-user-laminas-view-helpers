<?php

declare(strict_types=1);

namespace LmcTest\User\Mezzio\View;

use Lmc\User\Mezzio\View\ConfigProvider;
use PHPUnit\Framework\TestCase;

final class ConfigProviderTest extends TestCase
{
    public function testConfigProvide(): void
    {
        $configProvider = new ConfigProvider();
        $this->assertArrayHasKey('templates', $configProvider());
        $this->assertArrayHasKey('dependencies', $configProvider());
        $this->assertArrayHasKey('view_helpers', $configProvider());
    }
}
