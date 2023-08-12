<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weapon Create</title>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="mx-3">
    
    @include('layouts.temp-navigation')

    <p>
        Type: {{$type}}
    </p>

    <form action="{{route('weapons.store')}}" method="post" enctype="multipart/form-data">
        
        @csrf

        <h1 class="text-lg font-bold my-3">Crear Arma</h1>

        {{-- Input Name --}}
        <p>Nombre</p>
        <input
            type="text"
            name="name"
            value="{{old('name')}}"
            class="w-48 mb-3"
        >
        @error('name')
            <p
                class="text-red-400"
            >{{$message}}</p>
        @enderror

        {{-- Input Description --}}
        <p>Descripcion</p>
        <textarea
            name="description"
            class="w-48 mb-3"
        >{{old('description')}}</textarea>

        @error('description')
            <p
                class="text-red-400"
            >{{$message}}</p>
        @enderror

        {{-- Curiosities --}}
        <p>Curiosidades</p>
        @for($i = 0; $i < 3; $i++)
            <input
                type="text"
                name="curiosities[]"
                value="{{old("curiosities.$i")}}"
                class="w-48 mb-3"
                placeholder="Curiosidad {{$i + 1}}"
            > <br>
        @endfor

        @error("curiosities.*")
            <p
                class="text-red-400"
            >{{$message}}</p>
        @enderror

        @error("curiosities")
            <p
                class="text-red-400"
            >{{$message}}</p>
        @enderror

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
    </form>
</body>
</html>