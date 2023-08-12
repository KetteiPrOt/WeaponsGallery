<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Weapon;

class Curiosity extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'weapon_id'];

    public function weapon(){
        return $this->belongsTo(Weapon::class);
    }
}
