<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function redirect(){
        return redirect()->route('weapons.index', 'ar');
    }

    public function index(string $type){
        $exist = $this->validateType($type);

        // Retornar las armas del tipo solicitado
        if($exist){
            $weapons = Weapon::allWeapons($type);
            $types = Type::all();
            return view('weapons.index', compact('weapons', 'types'));
        } else {
            // Si el tipo no existe retorna a la raiz
            return redirect()->route('weapons.root');
        }
    }

    public function create(string $type){
        $exist = $this->validateType($type);

        // Retornar las el formulario para crear un arma del tipo actual
        if($exist){
            $types = Type::all();
            return view('weapons.create', compact('type', 'types'));
        } else {
            // Si el tipo no existe retorna a la raiz
            return redirect()->route('weapons.root');
        }
    }

    private function saveImage(UploadedFile $image): string
    {
        $path = $image->store('public', 'local'); // public/uZcgmofCinzVMcjVUC7VDB4ap4kdDbEbX3m083PA.jpg
        $name = substr($path, 7); // uZcgmofCinzVMcjVUC7VDB4ap4kdDbEbX3m083PA.jpg

        // ---- --- Filesystem
        // Storage::disk('local')->put('public/file_test.txt', "Hello World!");
        // dump(Storage::url('file_test.txt')); // /storage/file_test.txt
        // dump(asset('storage/file_test.txt')); // http://weaponsgallery.test/storage/file_test.txt

        Storage::disk('local')->put($path, $image->get());
        $imageUrl = Storage::url($name); // storage/uZcgmofCinzVMcjVUC7VDB4ap4kdDbEbX3m083PA.jpg
        // $imageAsset = asset($imageUrl);

        return $imageUrl;
        // return $imageAsset; // http://weaponsgallery.test/storage/uZcgmofCinzVMcjVUC7VDB4ap4kdDbEbX3m083PA.jpg
    }

    public function store(StoreWeaponRequest $request){
        // No olvidar validar la autenticacion en el form request 
        // para evitar que nos metan datos sin haberse logeado!
        /* --- Obtener los datos validados --- */
        $images = $request->all('main_image', 'secondary_images');
        $data = $request->collect();

        /* --- Almacenar imagenes en el disco local --- */
        $imageUrl = $this->saveImage($images['main_image']);
        $data->put('main_image', $imageUrl); // 'main_image' => storage/uZcgmofCinzVMcjVUC7VDB4ap4kdDbEbX3m083PA.jpg

        $secondaryImages = [];
        foreach($images['secondary_images'] as $image){
            $imageUrl = $this->saveImage($image);
            $secondaryImages[] = $imageUrl;
        }
        $data->put('secondary_images', $secondaryImages);  // $secondaryImages = [ "url...", "url...", "url..."];

        /* --- Almacenar datos en la Base de Datos --- */
        Weapon::saveWeapon($data);

        /* --- Retornar a la vista del tipo de arma creado --- */
        return redirect()->route('weapons.index', $data->get('type'));
    }

    public function edit(Weapon $weapon){
        // Obtener los tipos para el menu de navegacion
        $types = Type::all();

        // Obtener datos relacionados el arma
        $weapon = Weapon::findRelations($weapon);
        
        // Retornar la vista con el formulario de edicion
        return view('weapons.edit', compact('weapon', 'types'));
    }

    private function deleteImage(string $url){
        // $url = storage/uZcgmofCinzVMcjVUC7VDB4ap4kdDbEbX3m083PA.jpg;
        // $path = 'public/' . substr(8, $url) = public/uZcgmofCinzVMcjVUC7VDB4ap4kdDbEbX3m083PA.jpg;
        $path = 'public/' . substr($url, 8);
        
        Storage::disk('local')->delete($path);
    }

    public function update(UpdateWeaponRequest $request, Weapon $weapon){
        // No olvidar validar la autenticacion en el form request 
        // para evitar que nos metan datos sin haberse logeado!
        /* --- Obtener los datos validados --- */
        $images = $request->all('main_image', 'secondary_images');
        $data = $request->collect();

        /* --- Eliminar las imagenes antiguas del disco local y obtener las nuevas --- */
        if($images['main_image']){
            // Eliminar la imagen principal del disco local
            $mainImage = $weapon->mainImage;
            $this->deleteImage($mainImage->image_url);
            // Almacena la nueva imagen en el disco local
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

        /* --- Actualizar datos en la Base de Datos --- */
        Weapon::updateWeapon($data, $weapon);

        /* --- Retornar a la vista del arma actualizada --- */
        return redirect()->route('weapons.index', $data->get('type'));
    }

    public function destroy(Weapon $weapon){
        /* --- Eliminar las imagenes del disco local --- */
        $mainImage = $weapon->mainImage;
        $this->deleteImage($mainImage->image_url);

        foreach($weapon->secondaryImages as $image){
            $this->deleteImage($image->image_url);
        }

        /* --- Eliminar el arma de la Base de Datos --- */
        $weapon->delete();

        return redirect()->route('weapons.index', $weapon->type->name);
    }
}
