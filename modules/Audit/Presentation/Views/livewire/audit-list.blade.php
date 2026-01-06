<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Auditoría') }}
        </h2>
        <div class="text-sm">
            {{$fileName}}
        </div>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" text-gray-900 space-y-4">
                <div class="flex justify-start gap-2">
                    @if(count($hashes) !== 1)
                        <div class="space-y-1">
                            @foreach($hashes as $hash)
                                <button
                                    class="border block w-40 w-full rounded shadow px-4 py-1  @if($selectedHash == $hash) bg-accent text-white @else bg-white @endif"
                                    wire:click="setSelectedHash('{{$hash}}')"
                                ">
                                Análisis {{$loop->index + 1}}
                                </button>
                            @endforeach
                        </div>
                    @endif
                    @if($selectedHash)
                        <div class="w-full">
                            <livewire:audit-detail :hash="$selectedHash" wire:key="{{$selectedHash}}"/>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
