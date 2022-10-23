<?php

namespace Ammardev\CommonMarkImageTools;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Extension\ExtensionInterface;

final class ImageToolsExtension implements ExtensionInterface
{
    private ImagePathManagerContract $pathManager;

    public function __construct(?ImagePathManagerContract $pathManager = null)
    {
        $this->pathManager = $pathManager ?? new DefaultImagePathManager();
    }

    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment
            ->addRenderer(Image::class, new ImageRenderer($environment->getConfiguration(), $this->pathManager), 1);
    }
}
