<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Weapon;
use App\Models\Type;
use App\Models\Curiosity;
use App\Models\Image;
use App\Models\CarouselBanner;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /* --- Tablas `types`, `weapons`, `images`, y `curiosities` --- */
        $names = ['ar', 'smg', 'sg', 'rf', 'hg'];
        foreach($names as $name){
            Weapon::factory()->count(3)
                ->has(
                    Image::factory()->count(4)->sequence(
                        ['is_banner' => false],
                        ['is_banner' => false],
                        ['is_banner' => false],
                        ['is_banner' => true]
                    )
                )
                ->has(
                    Curiosity::factory()->count(3)
                )
                ->for(
                    Type::factory()->state([
                        'name' => $name
                    ])
                )->create();
            
            /* --- Tablas `carousel_banners` --- */
            $carrouselBanner = new CarouselBanner();
            $carrouselBanner->image = fake()->image();
            $carrouselBanner->save();
        }
    }
}
