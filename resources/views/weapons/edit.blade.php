<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Arma') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    {{-- Edit Weapon Form --}}
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Informacion del Arma') }}
                            </h2>
                    
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Cambia la informacion actual del arma por una nueva:") }}
                            </p>
                        </header>

                        <form action="{{ route('weapons.update', $weapon->id) }}" method="post" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf

                            @method('put')

                            {{-- Name --}}
                            <div>
                                <x-input-label for="name" :value="__('Nombre')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $weapon->name)" minlength="2" maxlength="25" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            {{-- Description --}}
                            <div>
                                <x-input-label for="description" :value="__('Descripción')" />
                                <x-textarea-input
                                    id="description" name="description" required
                                    minlength="100" maxlength="300" class="mt-1 block w-full"
                                >
                                    {{old('description', $weapon->description)}}
                                </x-textarea-input>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            {{-- Curiosities --}}
                            <div>
                                <x-input-label :value="__('Curiosidades')" />
                                @for($i = 0; $i < 3; $i++)
                                    <x-text-input id="curiosity_{{$i}}" name="curiosities[]" type="text" class="mt-1 block w-full" :value="old('curiosities.' . $i, $weapon->curiosities[$i]->text)" placeholder="Curiosidad {{$i + 1}}" minlength="20" maxlength="60" required autofocus />
                                @endfor
                                <x-input-error class="mt-2" :messages="$errors->get('curiosities.*')" />
                                <x-input-error class="mt-2" :messages="$errors->get('curiosities')" />
                            </div>

                            {{-- Main Image --}}
                            <div>
                                <x-input-label :value="__('Imagen Principal')" />
                                <p class="text-yellow-500">Asegurate que sea de la misma dimension que las otras imagenes.</p>
                                <x-file-input name="main_image" />
                                <x-input-error class="mt-2" :messages="$errors->get('main_image')" />
                            </div>

                            {{-- Secondary Images --}}
                            <div>
                                <x-input-label :value="__('Imagenes Secundarias')" />
                                <p class="text-yellow-500">Asegurate que sean de la misma dimension que las otras imagenes.</p>
                                <x-file-input name="secondary_images[]" class="mt-2" />
                                <x-file-input name="secondary_images[]" class="mt-2" />
                                <x-file-input name="secondary_images[]" class="mt-2" />
                                <x-input-error :messages="$errors->get('secondary_images.*')" class="mt-2" />
                                <x-input-error :messages="$errors->get('secondary_images')" class="mt-2" />
                            </div>

                            {{-- Weapon Type --}}
                            <div class="hidden">
                                <x-text-input name="type" :value="$weapon->type->name" />
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
    </div>

</x-app-layout>