<?php

namespace Ammardev\CommonMarkImageTools;

use League\CommonMark\Extension\CommonMark\Renderer\Inline\ImageRenderer as BaseImageRenderer;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\Config\ConfigurationInterface;

class ImageRenderer implements NodeRendererInterface
{
    private BaseImageRenderer $baseImageRenderer;
    private ImagePathManagerContract $pathManager;

    public function __construct(ConfigurationInterface $config, ImagePathManagerContract $pathManager)
    {
        $this->baseImageRenderer = new BaseImageRenderer();
        $this->baseImageRenderer->setConfiguration($config);
        $this->pathManager = $pathManager;
    }

    public function render(Node $node, ChildNodeRendererInterface $childRenderer): HtmlElement
    {
        /** @var HtmlElement $element */
        $element = $this->baseImageRenderer->render($node, $childRenderer);
        $attributes = $element->getAllAttributes();

        $storagePath = $this->pathManager->getImageStoragePath($attributes['src']);
        $attributes['src'] = $this->pathManager->getImagePublicSrcPath($attributes['src']);

        [$width, $height] = getimagesizefromstring($storagePath);

        $attributes['width'] ??= (string) $width;
        $attributes['height'] ??= (string) $height;

        return new HtmlElement('img', $attributes);
    }
}
