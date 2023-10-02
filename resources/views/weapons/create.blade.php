<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Arma') }}
        </h2>
    </x-slot>

    <main class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    {{-- Create Weapon Form --}}
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Informacion del Arma') }}
                            </h2>
                    
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Agrega la informacion necesaria para agregar un arma nueva a la galería:") }}
                            </p>
                        </header>
                    
                        <form method="post" action="{{ route('weapons.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf

                            {{-- Name --}}
                            <div>
                                <x-input-label for="name" :value="__('Nombre')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" minlength="5" maxlength="40" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            {{-- Description --}}
                            <div>
                                <x-input-label for="description" :value="__('Descripción')" />
                                <x-textarea-input
                                    id="description" name="description" required
                                    minlength="20" maxlength="500" class="mt-1 block w-full"
                                >
                                    {{old('description')}}
                                </x-textarea-input>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            {{-- Curiosities --}}
                            <div>
                                <x-input-label :value="__('Curiosidades')" />
                                @for($i = 0; $i < 3; $i++)
                                    <x-text-input id="curiosity_{{$i}}" name="curiosities[]" type="text" class="mt-1 block w-full" :value="old('curiosities.' . $i)" placeholder="Curiosidad {{$i + 1}}" minlength="10" maxlength="100" required autofocus />
                                @endfor
                                <x-input-error class="mt-2" :messages="$errors->get('curiosities.*')" />
                                <x-input-error class="mt-2" :messages="$errors->get('curiosities')" />
                            </div>

                            {{-- Main Image --}}
                            <div>
                                <x-input-label :value="__('Imagen Principal')" />
                                <x-file-input name="main_image" />
                                <x-input-error class="mt-2" :messages="$errors->get('main_image')" />
                            </div>

                            {{-- Secondary Images --}}
                            <div>
                                <x-input-label :value="__('Imagenes Secundarias')" />
                                <x-file-input name="secondary_images[]" class="mt-2" />
                                <x-file-input name="secondary_images[]" class="mt-2" />
                                <x-file-input name="secondary_images[]" class="mt-2" />
                                <x-input-error :messages="$errors->get('secondary_images.*')" class="mt-2" />
                                <x-input-error :messages="$errors->get('secondary_images')" class="mt-2" />
                            </div>

                            {{-- Weapon Type --}}
                            <div>
                                <x-input-label :value="__('Tipo de Arma')" />
                                <x-select-input name="type">
                                    @foreach($types as $weaponType)
                                        <option
                                            value="{{$weaponType->name}}"
                                            @selected($type == $weaponType)
                                        >{{strtoupper($weaponType->name)}}</option>
                                    @endforeach
                                </x-select-input>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>

                            {{-- Save Button --}}
                            <div class="flex justify-center items-center gap-4 sm:justify-start">
                                <x-primary-button>{{ __('Guardar') }}</x-primary-button>
                            </div>
                        </form> 
                    </section>    
                </div>
            </div>
        </div>
    </main>

    @include('layouts.footer')
</x-app-layout>