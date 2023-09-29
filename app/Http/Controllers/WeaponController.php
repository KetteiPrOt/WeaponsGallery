<?php

namespace App\Http\Controllers;

use App\Models\Weapon;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreWeaponRequest;
use App\Http\Requests\UpdateWeaponRequest;
use Illuminate\Http\UploadedFile;

class WeaponController extends Controller
{
    private function validateType(string $type): bool
    {
        $exist = Type::where('name', $type)->exists();
        return $exist;
    }

    public function root(){
        return redirect()->route('weapons.index', 'ar');
    }

    public function index(string $type){
        $exist = $this->validateType($type);

        // Return weapons of the required type
        if($exist){
            return view('weapons.index', [
                'weapons' => Weapon::allWeapons($type), 
                'types' => Type::all(), 
                'requestType' => Type::where('name', $type)->first()
            ]);
        } else {
            // If the required type does not exist, then return to the root
            return redirect()->route('weapons.root');
        }
    }

    public function create(string $type){
        $exist = $this->validateType($type);

        // Return the form for create a new weapon of the current type
        if($exist){
            $types = Type::all();
            return view('weapons.create', [
                'type' => $type, 
                'types' => $types
            ]);
        } else {
            // If the required type does not exist, then return to the root
            return redirect()->route('weapons.root');
        }
    }

    private function saveImage(UploadedFile $image): string
    {
        // Save the image in local storage

        $path = $image->store('public', 'local');
        // public/uZcgmofCinzVMcjVUC7VDB4ap4kdDbEbX3m083PA.jpg
        $name = substr($path, 7); 
        // uZcgmofCinzVMcjVUC7VDB4ap4kdDbEbX3m083PA.jpg

        Storage::disk('local')->put($path, $image->get());
        $imageUrl = Storage::url($name);
        // storage/uZcgmofCinzVMcjVUC7VDB4ap4kdDbEbX3m083PA.jpg

        return $imageUrl;
    }

    public function store(StoreWeaponRequest $request){
        /* --- Get the validated data --- */
        $images = $request->all('main_image', 'secondary_images');
        $data = $request->collect();

        /* --- Save the images in local storage --- */
        $imageUrl = $this->saveImage($images['main_image']);
        $data->put('main_image', $imageUrl); // 'main_image' => storage/uZcgmofCinzVMcjVUC7VDB4ap4kdDbEbX3m083PA.jpg

        $secondaryImages = [];
        foreach($images['secondary_images'] as $image){
            $imageUrl = $this->saveImage($image);
            $secondaryImages[] = $imageUrl;
        }
        $data->put('secondary_images', $secondaryImages);  // $secondaryImages = [ "url...", "url...", "url..."];

        /* --- Save the data in the database --- */
        Weapon::saveWeapon($data);

        /* --- Return the view of the created weapon type --- */
        return redirect()->route('weapons.index', $data->get('type'));
    }

    public function edit(Weapon $weapon){
        // Return the view with the edit form
        return view('weapons.edit', [
            'weapon' => $weapon, 
            'types' => Type::all()
        ]);
    }

    private function deleteImage(string $url){
        // $url = storage/uZcgmofCinzVMcjVUC7VDB4ap4kdDbEbX3m083PA.jpg;
        $path = 'public/' . substr($url, 8);
        // $path = 'public/' . substr(8, $url) = public/uZcgmofCinzVMcjVUC7VDB4ap4kdDbEbX3m083PA.jpg;
        
        Storage::disk('local')->delete($path);
    }

    public function update(UpdateWeaponRequest $request, Weapon $weapon){
        /* --- Get the validated data --- */
        $images = $request->all('main_image', 'secondary_images');
        $data = $request->collect();

        /* --- Delete the old images in local storage, and get the new images --- */
        if($images['main_image']){
            // Delete the main image in local storage
            $mainImage = $weapon->mainImage;
            $this->deleteImage($mainImage->image_url);
            // Save the new main image in local storage
            $imageUrl = $this->saveImage($images['main_image']);
            $data->put('main_image', $imageUrl); // 'main_image' => storage/uZcgmofCinzVMcjVUC7VDB4ap4kdDbEbX3m083PA.jpg
        }

        if($images['secondary_images']){
            $secondaryImagesUrls = [];
            $secondaryImages = $weapon->secondaryImages;

            foreach($images['secondary_images'] as $key => $image){
                $this->deleteImage($secondaryImages->get($key)->image_url);
                $imageUrl = $this->saveImage($image);
                $secondaryImagesUrls[$key] = $imageUrl;

                $data->put('secondary_images', $secondaryImagesUrls);  // $secondaryImages = [ "url...", "url...", "url..."];
            }
        }

        /* --- Update data in the database --- */
        Weapon::updateWeapon($data, $weapon);

        /* --- Return the updated weapon view --- */
        return redirect()->route('weapons.index', $data->get('type'));
    }

    public function destroy(Weapon $weapon){
        /* --- Delete images from local storage --- */
        $mainImage = $weapon->mainImage;
        $this->deleteImage($mainImage->image_url);

        foreach($weapon->secondaryImages as $image){
            $this->deleteImage($image->image_url);
        }

        /* --- Delete the weapon from the database --- */
        $weapon->delete();

        return redirect()->route('weapons.index', $weapon->type->name);
    }
}
