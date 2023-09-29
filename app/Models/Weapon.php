<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type;
use App\Models\Curiosity;
use App\Models\MainImage;
use App\Models\SecondaryImage;

class Weapon extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'type_id'];

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function curiosities(){
        return $this->hasMany(Curiosity::class);
    }

    public function mainImage(){
        return $this->hasOne(MainImage::class);
    }

    public function secondaryImages(){
        return $this->hasMany(SecondaryImage::class);
    }

    public static function allWeapons(string $type){
        // Obtain all weapons of the same type
        $type = Type::where('name', $type)->first();
        $weapons = $type->weapons;
        
        // Return weapons
        return $weapons;
    }

    public static function saveWeapon($weapon){
        // Obtain weapon's id, and type's id
        $type_id = Type::where('name', $weapon->get('type'))->value('id');
        $weapon_id = Weapon::create([
            'name' => $weapon->get('name'),
            'description' => $weapon->get('description'),
            'type_id' => $type_id
        ])->id;

        // Create curiosities that belongs to weapon
        foreach($weapon->get('curiosities') as $curiosity){
            Curiosity::create([
                'text' => $curiosity,
                'weapon_id' => $weapon_id
            ]);
        }

        // Create images that belongs to weapon
        MainImage::create([
            'image_url' => $weapon->get('main_image'),
            'weapon_id' => $weapon_id
        ]);

        foreach($weapon->get('secondary_images') as $image){
            SecondaryImage::create([
                'image_url' => $image,
                'weapon_id' => $weapon_id,
            ]);
        }
    }

    public static function updateWeapon($data, $weapon){
        // Update weapon data
        $weapon->name = $data->get('name');
        $weapon->description = $data->get('description');
        $weapon->save();

        // Update curiosities
        $curiosities = $weapon->curiosities;
        foreach($curiosities as $key => $curiosity){
            $curiosity->text = $data->get('curiosities')[$key];
            $curiosity->save();
        }

        // Update images
        if($data->get('main_image')){
            $mainImage = $weapon->mainImage;
            $mainImage->image_url = $data->get('main_image');
            $mainImage->save();
        }

        if($data->get('secondary_images')){
            $secondaryImages = $weapon->secondaryImages;

            foreach($data->get('secondary_images') as $key => $image){
                $secondaryImage = $secondaryImages->get($key);
                $secondaryImage->image_url = $image;
                $secondaryImage->save();
            }
        }

        // Update type
        $type = $weapon->type;
        $type->name = $data->get('type');
        $type->save();
    }
}
