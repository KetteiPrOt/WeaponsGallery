<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class SecondaryImage extends Image
{
    use HasFactory;

    protected $table = 'secondary_images';
}
