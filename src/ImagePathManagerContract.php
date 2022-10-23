<?php

namespace Ammardev\CommonMarkImageTools;

interface ImagePathManagerContract
{
    public function getImageStoragePath(string $originalSrc): string;

    public function getImagePublicSrcPath(string $originalSrc): string;
}