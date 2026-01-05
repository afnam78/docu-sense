<div>
    <h4 class="text-md font-medium">{{$title}}</h4>
    <div class="space-y-1 text-sm mt-1">
        @foreach($items as $key => $item)
            <div
                @class([
   'ml-1' => is_numeric($key),
   'flex gap-1'
])
            >
                @if(!is_numeric($key))
                    <div class="font-medium">
                        {{$key}}:
                    </div>
                @else
                    <div>
                        &bull;
                    </div>
                @endif

                <div >
                    {{$item}}
                </div>
            </div>
        @endforeach
    </div>
</div>
