<?php

declare(strict_types=1);

use App\Enums\ImageFormatEnum;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Image Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default image processing driver that will be
    | used when manipulating or converting images. This driver is always
    | utilized unless another driver is explicitly specified instead.
    |
    | Supported: "gd", "imagick"
    |
    */

    'default' => env('IMAGE_DRIVER', 'imagick'),

    /*
    |--------------------------------------------------------------------------
    | Default Image Format
    |--------------------------------------------------------------------------
    |
    | This value is the default image format
    | that should be used for all images.
    |
    */

    'default_format' => ImageFormatEnum::JPEG->value,

];
