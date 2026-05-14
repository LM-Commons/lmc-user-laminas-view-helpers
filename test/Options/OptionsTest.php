<?php

declare(strict_types=1);

namespace LmcTest\User\Mezzio\View\Options;

use Lmc\User\Mezzio\View\Options\Options;
use PHPUnit\Framework\TestCase;

final class OptionsTest extends TestCase
{
    public function testNoConfig(): void
    {
        $options = new Options();
        $this->assertEquals(['login-widget' => 'lmcuser-view::login-widget'], $options->getTemplateMap());
        $this->assertEquals('lmcuser-view::login-widget', $options->getTemplate('login-widget'));
    }

    public function testTemplateMapReplace(): void
    {
        $options = new Options([
            'template_map' => [
                'login-widget' => 'foo',
            ],
        ]);
        $this->assertEquals(['login-widget' => 'foo'], $options->getTemplateMap());
        $this->assertEquals('foo', $options->getTemplate('login-widget'));
    }

    public function testTemplateMapMerge(): void
    {
        $options = new Options([
            'template_map' => [
                'foo' => 'bar',
            ],
        ]);
        $this->assertEquals([
            'login-widget' => 'lmcuser-view::login-widget',
            'foo'          => 'bar',
        ], $options->getTemplateMap());
        $this->assertEquals('bar', $options->getTemplate('foo'));
    }

    public function testSetTemplateMap(): void
    {
        $options = new Options([]);
        $options->setTemplateMap([
            'foo' => 'bar',
        ]);
        $this->assertEquals([
            'login-widget' => 'lmcuser-view::login-widget',
            'foo'          => 'bar',
        ], $options->getTemplateMap());
    }
}
