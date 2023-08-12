<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weapon Index</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="mx-3">

    @include('layouts.temp-navigation')

    <h1
        class="
            text-3xl
            font-bold
        "
    >
        Indice
    </h1>
    @foreach ($weapons as $weapon)
        <ul
            class="list-inside"
        >
            {{-- Link de Edicion --}}
            <li>
                <a
                    class="
                        text-blue-400 underline
                    "
                    href="{{route('weapons.edit', $weapon->id)}}"
                >
                    Editar Arma
                </a>
            </li>
            {{-- Boton de Eliminacion --}}
            <li>
                <form action="{{route('weapons.destroy', $weapon->id)}}" method="post">

                    @csrf

                    @method('delete')

                    <button
                        class="
                            text-red-400 underline
                        "
                        type="submit"
                    >
                        Eliminar Arma
                    </button>
                </form>
            </li>
            {{-- Nombre y descripcion --}}
            <li>
                <span class="font-black text-red">{{$weapon->name}}: </span>
                {{$weapon->description}}
            </li>
            {{-- Curiosidades --}}
            @foreach ($weapon->curiosities as $curiosity)
                <li>
                    {{$curiosity->text}}
                </li>
            @endforeach
            {{-- Imagen Principal --}}
            <p>Imagen Principal</p>
            <img class="w-32 h-32 inline-block" src="{{asset($weapon->mainImage->image_url)}}">
            {{-- Imagenes Secundarias --}}
            <p>Images Secundarias</p>
            @foreach ($weapon->secondaryImages as $image)
                <img class="w-32 h-32 inline-block" src="{{asset($image->image_url)}}">
            @endforeach
        </ul>
    @endforeach
    
    <a
        href="{{route('weapons.create', $weapon->type->name)}}"
        class="
            w-32 h-32 my-3
            border rounded border-black
            flex justify-center items-center
        "
    >
        Agregar
    </a>
</body>
</html>