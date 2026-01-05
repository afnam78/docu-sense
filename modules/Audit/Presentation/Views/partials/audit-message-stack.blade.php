<div>
    <h4 class="text-md font-medium">{{$title}}</h4>
    <div class="space-y-1">
        @forelse($items as $item)
            @php($statusEnum = $item['status'])
            <div class="block">
                <x-badge type="{{$statusEnum->badge()}}">
                    {{$item['title']}}
                </x-badge>
            </div>
        @empty
            <div class="block">
                <x-badge type="success">
                    OK
                </x-badge>
            </div>
        @endforelse
    </div>
</div>
