<x-guest-layout>

    @include('layouts.navigation', ['requestType' => $requestType])

    <header class="pt-3 w-10/12 mx-auto">
        
        {{-- Weapons Carousel  --}}
        @include('layouts.weapons-carousel', ['types' => $types, 'requestType' => $requestType])
        
        {{-- Main Title --}}
        <h1 class="text-center text-3xl font-medium text-gray-700 mt-3">
            {{$requestType->large_name}}
        </h1>

        {{-- Section Divisor --}}
        <div class="block h-[0.4px] w-full bg-gray-300/75 mt-3"></div>

        {{-- Weapon Type Description --}}
        <p class="text-justify mt-3">
            {{$requestType->description}}
        </p>
    </header>

    <main class="flex flex-wrap items-start justify-evenly py-6 sm:w-10/12 sm:mx-auto">
        {{-- Weapon Cards --}}
        @foreach($weapons as $key => $weapon)
            <div class="mt-6 max-w-sm border-transparent rounded overflow-hidden shadow-lg">

                {{-- Modal --}}
                <x-weapon-card-modal :weapon="$weapon" :key="$key" />

                {{-- Acordeon --}}
                <x-weapon-card-acordeon :weapon="$weapon" :key="$key" />
                
            </div>
        @endforeach

        {{-- Agregar Arma --}}
        @auth
            <div
                class="mt-6 max-w-sm overflow-hidden rounded shadow-lg"
            >
                {{-- Fake Image --}}
                <a
                    class="block px-2 rounded border border-b-0 border-neutral-200"
                    href="{{route('weapons.create', $weapon->type->name)}}"
                >
                    <!-- Button trigger -->
                    <button
                        type="button"
                        class="rounded"
                    >
                        <div class="flex justify-center aling-center w-full h-2/3">
                            <svg class="w-1/3 mx-12 my-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#aaaaaa"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
                        </div>
                    </button>
                </a>
            </div>
        @endauth
        
        {{-- Section divisor --}}
        <div class="block h-[0.4px] w-full bg-gray-300/75 mt-12"></div>
    </main>

    @include('layouts.footer')
    
</x-guest-layout>