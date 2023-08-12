<?php

namespace Database\Factories;

use Database\Factories\ImageFactory;
use App\Models\SecondaryImage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SecondaryImage>
 */
class SecondaryImageFactory extends ImageFactory
{   
    protected $model = SecondaryImage::class;
}
