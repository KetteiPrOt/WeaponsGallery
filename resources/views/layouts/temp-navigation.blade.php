<div
    class="
        flex
        p-2
        border rounded border-black
    "
>
    @foreach($types as $type)
        <a href="{{route('weapons.index', $type->name)}}" class="mr-6">
            {{strtoupper($type->name)}}
        </a>
    @endforeach

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