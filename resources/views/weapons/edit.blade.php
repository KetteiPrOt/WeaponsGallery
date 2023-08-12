<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weapon Edit</title>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="mx-3">
    
    @include('layouts.temp-navigation')

    <form action="{{route('weapons.update', $weapon->id)}}" method="post" enctype="multipart/form-data">
        
        @csrf

        @method('put')

        <h1 class="text-lg font-bold my-3">Actualizar Arma</h1>

        {{-- Input Name --}}
        <p>Nombre</p>
        <input
            type="text"
            name="name"
            value="{{old('name', $weapon->name)}}"
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
        >{{old('description', $weapon->description)}}</textarea>

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
                value="{{old("curiosities.$i", $weapon->curiosities[$i]->text)}}"
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

        <img class="w-32 h-32 inline-block" src="{{asset($weapon->mainImage->image_url)}}">

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

        @foreach ($weapon->secondaryImages as $image)
            <img class="w-32 h-32 inline-block" src="{{asset($image->image_url)}}">
        @endforeach

        {{-- Input Type --}}
        <p>Tipo de arma</p>
        <p>
            Tipo: {{strtoupper($weapon->type->name)}}
        </p>
        <input
            name="type"
            value="{{$weapon->type->name}}"
            hidden
        >
        @error('type')
            <p
                class="text-red-400"
            >{{$message}}</p>
        @enderror
        

        <button class="p-2 border rounded border-gray-400 mt-3" type="submit">Enviar</button>
    </form>
</body>
</html>