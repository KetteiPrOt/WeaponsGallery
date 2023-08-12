<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Weapon;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['image_url', 'weapon_id'];

    public function weapon(){
        return $this->belongsTo(Weapon::class);
    }
}
