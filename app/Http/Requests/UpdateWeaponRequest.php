<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateWeaponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // Characters allowed in the name: '\w', '-', ' '
        $nameRegex = "/^((\w)|(-)|( ))+$/";

        // Characters allowed in descriptions
        $textChars = ['(\\w)', '(-)', '( )', '(,)', '(\\.)', '(\\!)', '(\\?)', '(\\*)', '(\\))', '(\\()'];
        $textRegex = '/^(' . implode('|', $textChars) . ')+$/';
        // $textRegex = "/^((\w)|(-)|( )|(,)|(\.)|(\!)|(\?))+$/";

        // All rules array
        $rules['name'] = ['required', 'string', 'min:5', 'max:40', "regex:$nameRegex"];
        
        $rules['description'] = ['required', 'string', 'min:20', 'max:500', "regex:$textRegex"];

        $rules["curiosities"] = "required|array:0,1,2|min:3|max:3";
        $rules["curiosities.*"] = ['required', 'string', 'min:10', 'max:100', "regex:$textRegex"];

        $rules['main_image'] = ['image', 'max:5500'];

        $rules["secondary_images"] = "array:0,1,2|max:3";
        $rules["secondary_images.*"] = ['image', 'max:5500'];

        $rules['type'] = ['required', 'string', 'min:2', 'max:20', 'exists:App\Models\Type,name'];

        return $rules;
    }

    public function attributes(): array
    {
        $attributes = [
            'name' => 'nombre',
            'description' => 'description'
        ];
        
        $attributes["curiosities"] = "curiosidades";
        $attributes["curiosities.*"] = "curiosidad #:position";

        $attributes['main_image'] = 'imagen principal';

        $attributes["secondary_images"] = "imagenes secundarias";
        $attributes["secondary_images.*"] = "imagen secundaria #:position";

        $attributes['type'] = 'tipo';

        return $attributes;
    }

    public function messages(): array
    {
        $textMessage = 'Solo se permiten los simbolos _-,.!?()';

        return [
            'name.regex' => 'Solo se permiten los simbolos _  y -',
            'description.regex' => $textMessage,
            "curiosities.*.regex" => $textMessage . " en la curiosidad #:position",
            'main_image.dimensions' => 'Las dimensiones de la imagen deben estar en relacion 16:9.',
            'secondary_images.*.dimensions' => 'Las dimensiones de la imagen secundaria #:position deben estar en relacion 16:9.'
        ];
    }
}
