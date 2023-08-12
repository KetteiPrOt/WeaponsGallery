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
</div>