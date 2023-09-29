<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Arma') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
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
                    
                            <div>
                                <x-input-label for="name" :value="__('Nombre')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" minlength="5" maxlength="40" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

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

                            <div>
                                <x-input-label :value="__('Curiosidades')" />
                                @for($i = 0; $i < 3; $i++)
                                    <x-text-input id="curiosity_{{$i}}" name="curiosities[]" type="text" class="mt-1 block w-full" :value="old('curiosities.' . $i)" placeholder="Curiosidad {{$i + 1}}" minlength="10" maxlength="100" required autofocus />
                                @endfor
                                <x-input-error class="mt-2" :messages="$errors->get('curiosities.*')" />
                                <x-input-error class="mt-2" :messages="$errors->get('curiosities')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Guardar') }}</x-primary-button>
                            </div>
                    
                            {{-- 
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    
                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div>
                                        <p class="text-sm mt-2 text-gray-800">
                                            {{ __('Your email address is unverified.') }}
                    
                                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                {{ __('Click here to re-send the verification email.') }}
                                            </button>
                                        </p>
                    
                                        @if (session('status') === 'verification-link-sent')
                                            <p class="mt-2 font-medium text-sm text-green-600">
                                                {{ __('A new verification link has been sent to your email address.') }}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                    
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                    
                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div> --}}
                        </form> 
                       
                    </section>    
                </div>
            </div>
        </div>
    </div>

    <div class="hidden">
        
        {{-- Imagen Principal --}}
        <p>Imagen Principal</p>
        <input
            type="file"
            name="main_image"
        > <br>

        @error('main_image')
            <p
                class="text-red-400"
            >{{$message}}</p>
        @enderror

        {{-- Imagenes Secundarias --}}
        <p>Imagenes Secundarias</p>
        @for($i = 0; $i < 3; $i++)
            <input
                type="file"
                name="secondary_images[]"
                class="mb-3"
            > <br>
        @endfor

        @error("secondary_images.*")
            <p
                class="text-red-400"
            >{{$message}}</p>
        @enderror

        @error("secondary_images")
            <p
                class="text-red-400"
            >{{$message}}</p>
        @enderror

        {{-- Input Type --}}
        <p>Tipo de arma</p>
        <select name="type">
            @foreach($types as $weaponType)
                <option
                    value="{{$weaponType->name}}"
                    @selected($type == $weaponType->name)
                >
                    {{strtoupper($weaponType->name)}}
                </option>
            @endforeach
        </select>
        @error('type')
            <p
                class="text-red-400"
            >{{$message}}</p>
        @enderror

        <br>
        <button class="p-2 border rounded border-gray-400 mt-3" type="submit">Enviar</button>
    </div>
</x-app-layout>