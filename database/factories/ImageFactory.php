<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     public function definition(): array
     {
         /* --- Descarga una imagen en el almacenamiento local  --- */
         $directory = str_replace('database\\factories', 'storage\\app\\public\\', __DIR__);
         // __DIR__ = C:\xampp\htdocs\WeaponsGallery\database\factories
         // $directory = C:\xampp\htdocs\WeaponsGallery\storage\app\public\
         $path = fake()->image(dir: $directory, fullPath: false);
         // fullPath: true = C:/xampp/htdocs/WeaponsGallery/storage/app/public/\ab3160f85bb685b3b34932f4bad1e8c3.png
         // fullPath: false = e07f18e199a2f3a9a6272a9dee51c631.png
 
         /* --- Guarda en la Base de Datos la URL
         Esta URL servira para hacer la imagen accesible mediante el metodo asset()
         El metodo asset() simplemente recibira la URL y retornara el link que permite acceder a la imagen.
         */
         $url = Storage::url($path);
         // $url = /storage/e07f18e199a2f3a9a6272a9dee51c631.png
         // asset($url) = http://weaponsgallery.test//storage/e07f18e199a2f3a9a6272a9dee51c631.png
 
         return [
             'image_url' => $url,
             'weapon_id' => fake()->numberBetween(1, 15)
         ];
     }
}
