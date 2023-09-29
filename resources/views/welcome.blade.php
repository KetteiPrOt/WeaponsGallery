<x-guest-layout>
    <p>
        Esta es una landing Page
    </p>
    
    <p>
        Bienvenido a la galeria de armas!
    </p>

    <a 
        class="text-indigo-600 underline"
        href="{{route('weapons.root')}}"
    >
        Visita nuestra Galeria de Armas
    </a>

    <p>
        Aqui podras encontrar las armas mas relevantes e interesantes de la historia... (Presentar la galeria de armas)
    </p>
</x-guest-layout>

@if (Route::has('login'))
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
        @auth
            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
            {{-- --- --- Sistema de registro
                Elimino el sistema de registro para impedir que visitantes se registren
                en el sitio.
            --}}
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
            @endif
        @endauth
    </div>
@endif