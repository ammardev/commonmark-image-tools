<?php

namespace Ammardev\CommonMarkImageTools;

class DefaultImagePathManager implements ImagePathManagerContract
{
    public function getImageStoragePath(string $originalSrc): string
    {
        return $originalSrc;
    }

    public function getImagePublicSrcPath(string $originalSrc): string
    {
        return $originalSrc;
    }
}