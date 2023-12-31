<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
/* --- Create Examples of Fake Weapons --- */
// use App\Models\Weapon;
// use App\Models\Curiosity;
// use App\Models\MainImage;
// use App\Models\SecondaryImage;
/* --- Create Default Admin User --- */
use App\Models\User; 
use Illuminate\Auth\Events\Registered; 
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* --- Create Weapon Types --- */
        $types = [
            'ar' => 'Rifles de Asalto',
            'smg' => 'Subametralladoras',
            'sg' => 'Escopetas',
            'rf' => 'Rifles de Francotirador',
            'hg' => 'Armas de Mano'
        ];
        $descriptions = [
            'ar' => 'Son fusiles diseñados para el combate, de fuego selectivo (automático/semiautomático) siendo el arma de infantería estándar en la mayoría de los ejércitos modernos. Han reemplazado o complementado ampliamente a los más grandes y potentes fusiles de tirador.',
            'smg' => 'Carabinas automáticas diseñadas para disparar munición de pistola con menor tamaño y potencia de fuego que un rifle de asalto, pero una gran cadencia de fuego en distancias cortas y espacios cerrados. Pierden su precision a largas distancias.',
            'sg' => 'Una escopeta es un arma de fuego de ánima lisa o rayada, diseñada para descargar varios proyectiles en cada disparo. En combate, el disparar proyectiles múltiples permite acertar con facilidad a corta distancia siendo un impacto de lleno demoledor.',
            'rf' => 'El rifle de francotirador es un tipo de arma que permite el disparo a objetivos a muy larga distancia buscando la mayor precisión posible en el disparo, para lo cual va equipado con una mira telescópica y utiliza munición específica que permite alcanzar largas distancias sin perder precisión.',
            'hg' => 'Una pistola es un arma de fuego corta diseñada para ser apuntada y disparada con una sola mano, o con dos, se puede utilizar para la caza dependiendo del arma, y funciona a corto alcance. Todos los modelos que utilizan las fuerzas de seguridad y los ejércitos son pistolas de doble acción.'
        ];

        foreach($types as $name => $large_name){
            Type::factory()->state([
                'name' => $name,
                'large_name' => $large_name,
                'description' => $descriptions[$name],
                'image_url' => 'storage/carouselBanners/' . $name . '.jpg'
            ])->create();
        }

        /* --- Create Default Admin User --- */
        $name = 'Fernando Joel Mero Travez'; $email = 'sd.kettei@gmail.com'; $password = '12345678';

        $user = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password),]);

        event(new Registered($user));

        /* --- Create Examples of Fake Weapons --- */
        // foreach($types as $name => $large_name){
        //     Weapon::factory()->count(3)
        //         ->has(
        //             MainImage::factory()->count(1)
        //         )
        //         ->has(
        //             SecondaryImage::factory()->count(3)
        //         )
        //         ->has(
        //             Curiosity::factory()->count(3)
        //         )
        //         ->for(
        //             Type::factory()->state([
        //                 'name' => $name,
        //                 'large_name' => $large_name,
        //                 'description' => $descriptions[$name],
        //                 'image_url' => 'storage/carouselBanners/' . $name . '.jpg'
        //             ])
        //         )->create();
        // }
    }
}
