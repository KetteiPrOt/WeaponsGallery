<select
    name="type"
    {!! $attributes->merge(['class' => '
        bg-white
        border-gray-300 rounded shadow-sm
        focus:outline-none
    ']) !!}
>
    {{$slot}}
</select>