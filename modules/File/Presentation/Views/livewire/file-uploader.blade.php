<div>
    <div class="p-6">
        <div
            x-data="{ isUploading: false, progress: 0, isDropping: false }"
            x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false; isDropping = false"
            x-on:livewire-upload-error="isUploading = false; isDropping = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress"
            class="relative"
        >
            <div
                x-on:dragover.prevent="isDropping = true"
                x-on:dragleave.prevent="isDropping = false"
                x-on:drop.prevent="isDropping = false"
                class="flex items-center justify-center w-full"
            >
                <label
                    for="dropzone-file"
                    :class="isDropping ? 'border-blue-500 bg-blue-50' : 'border-gray-300 bg-gray-50'"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed rounded-lg cursor-pointer hover:bg-gray-100 transition-colors"
                >
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Haz clic para subir</span> o arrastra y suelta</p>
                        <p class="text-xs text-gray-400">PDF, PNG, JPG (MÁX. 10MB)</p>
                    </div>

                    <input
                        id="dropzone-file"
                        type="file"
                        wire:model="files"
                        multiple
                        class="hidden"
                    />
                </label>
            </div>

            <div x-show="isUploading" class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" :style="`width: ${progress}%`"></div>
                </div>
                <span class="text-sm text-gray-600">Subiendo... <span x-text="progress"></span>%</span>
            </div>

            @if ($files)
                <div class="mt-4">
                    <h3 class="text-md font-medium text-gray-700">Archivos listos para subir:</h3>
                    <ul class="mt-2 divide-y divide-gray-200 border rounded-md">
                        @foreach ($files as $file)
                            <li class="p-2 flex justify-between items-center text-sm">
                                <span>{{ $file->getClientOriginalName() }}</span>
                                <span class="text-gray-400">{{ number_format($file->getSize() / 1024, 2) }} KB</span>
                            </li>
                        @endforeach
                    </ul>

                    <x-primary-button wire:click="save">
                        Guardar archivos
                    </x-primary-button>
                </div>
            @endif

            @error('files') <span class="text-red-500 text-sm italic">{{ $message }}</span> @enderror

            @if (session()->has('message'))
                <div class="mt-4 p-2 bg-green-100 text-green-700 rounded">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>
</div>
