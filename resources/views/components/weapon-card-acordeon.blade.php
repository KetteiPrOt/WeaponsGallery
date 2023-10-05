{{-- Acordeon --}}
<article id="accordion{{$key}}" class="rounded">

    <div class="rounded border border-neutral-200 bg-white">
        {{-- Expand Button --}}
        <h2 class="mb-0" id="heading{{$key}}">
            <button
                class="
                    z-50
                    group relative flex w-full items-center 
                    rounded-t-[15px] border-0 bg-white px-5 py-4 
                    text-left text-base text-neutral-800 
                    transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none 
                    dark:bg-neutral-800 dark:text-white 
                    [&:not([data-te-collapse-collapsed])]:bg-white 
                    [&:not([data-te-collapse-collapsed])]:text-primary 
                    [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] 
                    dark:[&:not([data-te-collapse-collapsed])]:bg-neutral-800 
                    dark:[&:not([data-te-collapse-collapsed])]:text-primary-400 
                    dark:[&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(75,85,99)]
                "
                type="button"
                data-te-collapse-init
                data-te-collapse-collapsed
                data-te-target="#collapse{{$key}}"
                aria-expanded="false"
                aria-controls="collapse{{$key}}"
            >
                {{$weapon->name}}
                <span
                    class="-mr-1 ml-auto h-5 w-5 shrink-0 rotate-[-180deg] fill-[#336dec] transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:mr-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-6 w-6">
                        <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </span>
            </button>
        </h2>

        {{-- Content --}}
        <div
            id="collapse{{$key}}"
            class="!visible hidden"
            data-te-collapse-item
            aria-labelledby="heading{{$key}}"
            data-te-parent="#accordion{{$key}}"
        >
            <div class="px-5 py-4 text-justify">
                {{-- Edit/Delete Weapon --}}
                <div class="flex flex-wrap justify-between mb-2">
                    @auth
                        {{-- Edit Weapon --}}
                        <a href="{{route('weapons.edit', $weapon->id)}}" class="text-blue-400">
                            {{-- Label --}}
                            Editar Arma
                            {{-- Icon --}}
                            <svg 
                                class="w-5 h-5 text-red-400 inline align-top"
                                fill="#00AAE4"
                                version="1.1"
                                id="Capa_1" 
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" 
                                viewBox="0 0 494.936 494.936"
                                xml:space="preserve"
                            >
                                <g>
                                    <g>
                                        <path d="M389.844,182.85c-6.743,0-12.21,5.467-12.21,12.21v222.968c0,23.562-19.174,42.735-42.736,42.735H67.157
                                            c-23.562,0-42.736-19.174-42.736-42.735V150.285c0-23.562,19.174-42.735,42.736-42.735h267.741c6.743,0,12.21-5.467,12.21-12.21
                                            s-5.467-12.21-12.21-12.21H67.157C30.126,83.13,0,113.255,0,150.285v267.743c0,37.029,30.126,67.155,67.157,67.155h267.741
                                            c37.03,0,67.156-30.126,67.156-67.155V195.061C402.054,188.318,396.587,182.85,389.844,182.85z"/>
                                        <path d="M483.876,20.791c-14.72-14.72-38.669-14.714-53.377,0L221.352,229.944c-0.28,0.28-3.434,3.559-4.251,5.396l-28.963,65.069
                                            c-2.057,4.619-1.056,10.027,2.521,13.6c2.337,2.336,5.461,3.576,8.639,3.576c1.675,0,3.362-0.346,4.96-1.057l65.07-28.963
                                            c1.83-0.815,5.114-3.97,5.396-4.25L483.876,74.169c7.131-7.131,11.06-16.61,11.06-26.692
                                            C494.936,37.396,491.007,27.915,483.876,20.791z M466.61,56.897L257.457,266.05c-0.035,0.036-0.055,0.078-0.089,0.107
                                            l-33.989,15.131L238.51,247.3c0.03-0.036,0.071-0.055,0.107-0.09L447.765,38.058c5.038-5.039,13.819-5.033,18.846,0.005
                                            c2.518,2.51,3.905,5.855,3.905,9.414C470.516,51.036,469.127,54.38,466.61,56.897z"/>
                                    </g>
                                </g>
                            </svg>
                        </a>

                        {{-- Delete Weapon Button --}}
                        <button
                            class="z-0 text-red-400"
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-weapon-deletion')"
                        >
                            {{-- Label --}}
                            Eliminar Arma
                            {{-- Icon --}}
                            <svg
                                class="w-5 h-5 inline align-top"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path d="M10 11V17" stroke="#CB3234" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 11V17" stroke="#CB3234" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4 7H20" stroke="#CB3234" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#CB3234" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#CB3234" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        {{-- Delete Weapon Modal --}}
                        <x-modal name="confirm-weapon-deletion">
                            <div class="flex justify-center items-center w-full h-full bg-transparent">
                                <form 
                                    class="p-6 m-auto" 
                                    action="{{route('weapons.destroy', $weapon->id)}}" 
                                    method="POST"
                                >

                                    @csrf

                                    @method('delete')

                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Seguro que deseas eliminar el arma?') }}
                                    </h2>
                        
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __('Una vez la elimines no podras recuperar ni la informacion ni las imagenes.') }}
                                    </p>

                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            {{ __('Cancelar') }}
                                        </x-secondary-button>
                        
                                        <x-danger-button class="ml-3">
                                            {{ __('Eliminar Arma') }}
                                        </x-danger-button>
                                    </div>
                                </form>
                            </div>
                        </x-modal>
                    @endauth
                </div>
                
                {{-- Weapon Description --}}
                <p class="break-words">
                    {{$weapon->description}}
                </p>

                {{-- Weapon Curiosities --}}
                <ul class="mt-3 w-full">
                    @foreach($weapon->curiosities as $curiosity)
                        <li class="py-3 border-t border-neutral-200 break-words">
                            {{$curiosity->text}}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</article>