<?php

declare(strict_types=1);

namespace Lmc\User\Mezzio\View\Options;

use Laminas\Stdlib\AbstractOptions;

use function array_merge;

/**
 * @template TValue
 * @extends AbstractOptions<TValue>
 */
final class Options extends AbstractOptions
{
    //phpcs:disable
    protected $__strictMode__ = false;
    //phpcs:enable

    /** @var array<array-key,string> */
    protected array $templateMap = [
        'login-widget' => 'lmcuser-view::login-widget',
    ];

    public function getTemplateMap(): array
    {
        return $this->templateMap;
    }

    /**
     * @param array<array-key, string> $templateMap
     */
    public function setTemplateMap(array $templateMap): self
    {
        $this->templateMap = array_merge($this->templateMap, $templateMap);
        return $this;
    }

    public function getTemplate(string $templateName): ?string
    {
        return $this->templateMap[$templateName] ?? null;
    }
}
