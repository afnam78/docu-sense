@php use Modules\File\Domain\Enums\StatusEnum; @endphp
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Archivos subidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 w-14">
                                    Acciones
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Estado
                                </th>
                                <th scope="col" class="px-2 py-3 text-center">
                                    Formato
                                </th>
                                <th scope="col" class="px-2 py-3 text-center">
                                    Nómina
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Fecha de subida
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($files as $file)
                                <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                                    <td class="px-6 py-4">
                                        @if($file->file->status === StatusEnum::DONE->value)
                                            <a href="{{ route('audit.detail', $file->file_hash) }}"
                                               class="">
                                                <x-eye class="size-5"/>
                                            </a>
                                        @endif
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $file->name }}
                                    </th>
                                    <td class="px-6 py-4 flex justify-center">
                                        @php
                                            $statusEnum = StatusEnum::from($file->file->status);
                                        @endphp
                                        <x-badge :type="$statusEnum->badge()">{{
    $statusEnum->label()
}}</x-badge>
                                    </td>
                                    <td class="px-2 py-4 text-center">
                                        {{ $file->file->mimetype }}
                                    </td>
                                    <td class="px-2 py-4">
                                       <span class="flex justify-center">
                                            @if($file->file->status === StatusEnum::DONE->value)
                                               @if($file->file->audits->isNotEmpty())
                                                   <x-check class="size-5 text-green-600"/>
                                               @else
                                                   <x-x-circle class="size-5 text-red-500"/>
                                               @endif
                                           @else

                                               <x-minus-circle class="size-5 text-gray-700"/>
                                           @endif
                                       </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $file->created_at->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $files->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
