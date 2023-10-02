<x-guest-layout :title="__('Contacto')">

    @include('layouts.navigation')

    <main class="pt-3 w-10/12 mx-auto min-h-screen">

        <h1 class="text-center text-3xl font-medium text-gray-700 mt-3">
            Contacto
        </h1>

        {{-- Section Divisor --}}
        <div class="block h-[0.4px] w-full bg-gray-300/75 mt-3"></div>

        <p class="text-justify mt-3">
            Ayudo a clientes interesados e innovadores de todo el mundo, a crear o modificar aplicaciones y sitios web que aumenten el crecimiento de sus negocios, para que puedan tener más estabilidad y autonomía en su vida haciendo lo que les apasiona.
        </p>

        <p class="text-justify mt-3">
            Escribe al correo <span class="text-blue-600">sd.kettei@gmail.com</span>, o encuentrame en:
        </p>

        <div class="mt-5 flex justify-around">
            <a class="social-network workana" href="https://www.workana.com/freelancer/6c171c074d558a9e217924f407440f4a">
                <img class="loaded-icon" src="{{asset('storage/icons/workana.png')}}" alt="Workana Icon">
                <span class="text-white">Workana</span>
            </a>
            <a class="social-network github" href="https://github.com/KetteiPrOt">
                <img class="loaded-icon" src="{{asset('storage/icons/github.png')}}" alt="Github Icon">
                <span class="text-white">Github</span>
            </a>
            <a class="social-network linkedin" href="https://www.linkedin.com/in/fernado-joel-mero-travez-0873b2259/">
                <svg class="loaded-icon" viewBox="0 0 72 72" xmlns="http://www.w3.org/2000/svg">
                    <g fill="none" fill-rule="evenodd">
                        <path d="M8,72 L64,72 C68.418278,72 72,68.418278 72,64 L72,8 C72,3.581722 68.418278,-8.11624501e-16 64,0 L8,0 C3.581722,8.11624501e-16 -5.41083001e-16,3.581722 0,8 L0,64 C5.41083001e-16,68.418278 3.581722,72 8,72 Z" fill="#007EBB"/>
                        <path d="M62,62 L51.315625,62 L51.315625,43.8021149 C51.315625,38.8127542 49.4197917,36.0245323 45.4707031,36.0245323 C41.1746094,36.0245323 38.9300781,38.9261103 38.9300781,43.8021149 L38.9300781,62 L28.6333333,62 L28.6333333,27.3333333 L38.9300781,27.3333333 L38.9300781,32.0029283 C38.9300781,32.0029283 42.0260417,26.2742151 49.3825521,26.2742151 C56.7356771,26.2742151 62,30.7644705 62,40.051212 L62,62 Z M16.349349,22.7940133 C12.8420573,22.7940133 10,19.9296567 10,16.3970067 C10,12.8643566 12.8420573,10 16.349349,10 C19.8566406,10 22.6970052,12.8643566 22.6970052,16.3970067 C22.6970052,19.9296567 19.8566406,22.7940133 16.349349,22.7940133 Z M11.0325521,62 L21.769401,62 L21.769401,27.3333333 L11.0325521,27.3333333 L11.0325521,62 Z" fill="#FFF"/>
                    </g>
                </svg>
                <span class="text-white">LinkedInc</span>
            </a>
        </div>
    </main>

    @include('layouts.footer')
</x-guest-layout>