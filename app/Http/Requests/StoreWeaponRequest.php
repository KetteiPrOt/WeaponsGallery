<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreWeaponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Auth::check()){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // Caracteres permitidos en el nombre
        $nameChars = ['(\\w)', '(-)', '( )'];
        $nameRegex = '/^(' . implode('|', $nameChars) . ')+$/';
        // $nameRegex = "/^((\w)|(-)|( ))+$/";

        // Caracteres permitidos en las descripciones
        $textChars = ['(\\w)', '(-)', '( )', '(,)', '(\\.)', '(\\!)', '(\\?)', '(\\*)', '(\\))', '(\\()'];
        $textRegex = '/^(' . implode('|', $textChars) . ')+$/';
        // $textRegex = "/^((\w)|(-)|( )|(,)|(\.)|(\!)|(\?))+$/";

        // Reglas para las curiosidades
        $curiosityRules = ['required', 'string', 'min:10', 'max:100', "regex:$textRegex"];

        // Reglas para las imagenes
        $imageRules = ['required', 'image', 'max:5500', 'dimensions:ratio=16/9'];

        // Reglas Finales
        $rules = [];

        $rules['name'] = [
            'required',
            'string',
            'min:5',
            'max:40',
            "regex:$nameRegex"
        ];
        
        $rules['description'] = [
            'required',
            'string',
            'min:20',
            'max:500',
            "regex:$textRegex"
        ];

        $rules["curiosities"] = "required|array:0,1,2|min:3|max:3";
        $rules["curiosities.*"] = $curiosityRules;

        $rules['main_image'] = $imageRules;

        $rules["secondary_images"] = "required|array:0,1,2|min:3|max:3";
        $rules["secondary_images.*"] = $imageRules;

        $rules['type'] = [
            'required',
            'string',
            'min:2',
            'max:20',
            'exists:App\Models\Type,name'
        ];

        return $rules;

        /*
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:20',
                "regex:$nameRegex"
            ],
            'description' => [
                'required',
                'string',
                'min:20',
                'max:500',
                "regex:$textRegex"
            ],
            'curiosities' => 'required|array:0,1,2|min:3|max:3',
            'curiosities.*' => $curiosityRules,
            'image_main' =>  $imageRules
            'images' => 'required|array:0,1,2|min:3|max:3',
            'images.*' => $imageRules,
            'type' => [
                'required',
                'string',
                'min:2',
                'max:20',
                'exists:App\Models\Type,name'
            ]
        ];
        */
    }

    public function attributes(): array
    {
        $attributes = [
            'name' => 'Nombre',
            'description' => 'Description'
        ];
        
        $attributes["curiosities"] = "Curiosidades";
        $attributes["curiosities.*"] = "Curiosidad #:position";

        $attributes['main_image'] = 'Imagen Principal';

        $attributes["secondary_images"] = "Imagenes Secundarias";
        $attributes["secondary_images.*"] = "Imagen Secundaria #:position";

        $attributes['type'] = 'Tipo';

        return $attributes;
    }

    public function messages(): array
    {
        // $nameRegex = "/^((\w)|(-)|( ))+$/";
        // $descriptionRegex = "/^((\w)|(-)|( )|(,)|(\.)|(\!)|(\?))+$/";
        $textMessage = 'Solo se permiten los simbolos _-,.!?()';

        $messages = [
            'name.regex' => 'Solo se permiten los simbolos _  y -',
            'description.regex' => $textMessage,
            "curiosities.*.regex" => $textMessage . " en la curiosidad #:position",
            'main_image.dimensions' => 'Las dimensiones de la imagen deben estar en relacion 16:9.',
            'secondary_images.*.dimensions' => 'Las dimensiones de la imagen secundaria #:position deben estar en relacion 16:9.'
        ];

        return $messages;
    }
}
