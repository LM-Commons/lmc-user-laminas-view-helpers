<?php

declare(strict_types=1);

namespace Lmc\User\Mezzio\View\Helper;

use Laminas\Form\FormInterface;
use Laminas\View\Helper\HelperInterface;
use Laminas\View\Model\ViewModel;
use Laminas\View\Renderer\RendererInterface;
use Override;

use function array_key_exists;

final class LmcUserLoginWidget implements HelperInterface
{
    protected RendererInterface $renderer;

    public function __construct(
        private readonly FormInterface $loginForm,
        private readonly string $viewTemplate,
        RendererInterface $renderer,
    ) {
        $this->renderer = $renderer;
    }

    public function __invoke(array $options = []): string|ViewModel
    {
        $render   = array_key_exists('render', $options) && $options['render'];
        $redirect = array_key_exists('redirect', $options) && $options['redirect'];

        $viewModel = new ViewModel([
            'loginForm' => $this->loginForm,
            'redirect'  => $redirect,
        ]);
        $viewModel->setTemplate($this->viewTemplate);
        if ($render) {
            return $this->getView()->render($viewModel);
        } else {
            return $viewModel;
        }
    }

    #[Override]
    public function getView(): RendererInterface
    {
        return $this->renderer;
    }

    #[Override]
    public function setView(RendererInterface $view): self
    {
        $this->renderer = $view;
        return $this;
    }
}
