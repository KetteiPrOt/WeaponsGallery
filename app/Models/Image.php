<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Weapon;

class Image extends Model
{
    use HasFactory;

    public function weapon(){
        return $this->belongsTo(Weapon::class);
    }
}
