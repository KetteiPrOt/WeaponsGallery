<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Weapon;

class Type extends Model
{
    use HasFactory;

    public function weapons(){
        return $this->hasMany(Weapon::class);
    }
}
