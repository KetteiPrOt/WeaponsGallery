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
            {{-- Nombre y descripcion --}}
            <li>
                <span class="font-black text-red">{{$weapon['name']}}: </span>
                {{$weapon['description']}}
            </li>
            {{-- Curiosidades --}}
            @foreach ($weapon['curiosities'] as $curiosity)
                <li>
                    {{$curiosity}}
                </li>
            @endforeach
            {{-- Imagenes --}}
            @foreach ($weapon['images'] as $image)
                <li>
                    {{$image}}
                </li>
            @endforeach
        </ul>
    @endforeach
</body>
</html>