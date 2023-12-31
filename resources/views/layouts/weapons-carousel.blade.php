{{-- Carousel --}}
<div
    id="weaponsCarousel"
    class="hidden sm:block relative"
    data-te-carousel-init
>

    <!--Carousel indicators-->
    <div
        class="absolute bottom-0 left-0 right-0 z-[2] mx-[15%] mb-4 flex list-none justify-center p-0"
        data-te-carousel-indicators
    >
        @for($i = 0; $i < $types->count(); $i++)
            <button
                type="button"
                data-te-target="#weaponsCarousel"
                data-te-slide-to="{{$i}}"
                data-te-carousel-active
                class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-black bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
                aria-current="true"
                aria-label="Slide {{$i + 1}}"
            ></button>
        @endfor
    </div>

    <!--Carousel items-->
    <div class="relative w-full overflow-hidden after:clear-both after:block after:content-['']">
        @foreach($types as $type)
            <div
                class="
                    {{($type->name != $requestType->name) ? 'hidden' : ''}}
                    relative float-left -mr-[100%] w-full 
                    transition-transform duration-[600ms] ease-in-out 
                    motion-reduce:transition-none
                "
                {{($type->name == $requestType->name) ? 'data-te-carousel-active' : ''}}
                data-te-carousel-item
            >
                <img
                    src="{{asset($type->image_url)}}"
                    class="block w-full"
                    alt="Imagen de un/una {{$type->large_name}}" 
                />
            </div>
        @endforeach
    </div>

    <!--Carousel controls - prev item-->
    <button
        class="absolute bottom-0 left-0 top-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-black opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-black hover:no-underline hover:opacity-90 hover:outline-none focus:text-black focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
        type="button"
        data-te-target="#weaponsCarousel"
        data-te-slide="prev"
    >
        <span class="inline-block h-8 w-8">
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
                d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </span>
        <span
        class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
        >Previous</span>
    </button>

    <!--Carousel controls - next item-->
    <button
        class="absolute bottom-0 right-0 top-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-black opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-black hover:no-underline hover:opacity-90 hover:outline-none focus:text-black focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
        type="button"
        data-te-target="#weaponsCarousel"
        data-te-slide="next"
    >
        <span class="inline-block h-8 w-8">
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
                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </span>
        <span
        class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
        >Next</span>
    </button>
    
</div>