<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type;
use App\Models\Curiosity;
use App\Models\Image;

class Weapon extends Model
{
    use HasFactory;

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function curiosities(){
        return $this->hasMany(Curiosity::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public static function obtainWeapons(string $type){
        /*
        $registers = [
            [
                'name' => '...'
                'description' => '...'
                'curiosities' => [ '...' , '...' , '...' ]
                'images' => [ 'path_1', 'path_2', 'path_3' ]
            ],
            [
                ...
            ],
            ...
        ];
        */
        // use App\Models\Type;
        $registers = [];

        $name = Type::where('name', $type)->first();
        $weapons = $name->weapons;
        for($i = 0; $i < count($weapons); $i++){
            $weapon = $weapons[$i];

            $register = [];
            // name
            $register['name'] = $weapon->name;
            // description
            $register['description'] = $weapon->description;
            // curiosities
            $curiosities = $weapon->curiosities;
            $array = [];
            for($j = 0; $j < count($curiosities); $j++){
                $array[] = $curiosities[$j]->curiosity;
            }
            $register['curiosities'] = $array;
            // images
            $images = $weapon->images;
            $array = [];
            for($j = 0; $j < count($images); $j++){
                $array[] = $images[$j]->image;
            }
            $register['images'] = $array;

            // Save register
            $registers[] = $register;
        }

        return $registers;
    }
}
