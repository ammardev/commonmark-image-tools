# CommonMark Image Tools

> **Warning**
> 
> [WIP] Public APIs of this package may have breaking changes.

An extension for [league/commonmark](https://commonmark.thephpleague.com) package which adds additional useful tools for displaying images.

## Features
* Modifying the `src` path easily.
* Add `width` and `height` attributes automatically to the `img` element to avoid layout shifts.

## Installation

```bash
composer require ammardev/commonmark-image-tools
```

## Usage

You can use the extension directly like this:
```php
$environment = new Environment();

$environment->addExtension(new Ammardev\CommonMarkImageTools\ImageToolsExtension());
```
In this case. The extension will use the provided image link to get the width and height of the image and add them as attributes. No modification will be made to the `src` in this case.

You can modify the public path (The path to be used in the `src` attribute). And you can modify the storage path (The path we will use to get the image from the storage and get width and height info) by implementing `Ammardev\CommonMarkImageTools\ImagePathManagerContract` interface.

```php
<?php

use Ammardev\CommonMarkImageTools\ImagePathManagerContract;

class ImagePathManager implements ImagePathManagerContract
{
    /**
    * This method will update the storage path that is used to get
    * the image and extract width and height info.
    */
    public function getImageStoragePath(string $originalSrc): string
    {
        return __DIR__ . '/storage/my-assets-folder/' . $originalSrc;
    }

    /**
    * This method will update the public path that will be used in
    * the src attribute.
    */
    public function getImagePublicSrcPath(string $originalSrc): string
    {
        return '/public/assets/' . $originalSrc;
    }
}
```


You can check [commonmark plugin docs](https://commonmark.thephpleague.com/2.3/extensions/overview/#usage) for more details about using extensions.

## TODO
- [ ] Add testing for the package.
- [ ] Add an easy way to change the image extension on the fly.
- [ ] Responsive Images option
