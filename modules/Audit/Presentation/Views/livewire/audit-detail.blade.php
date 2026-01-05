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
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-lg font-medium">Datos extraídos</h3>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium">Auditoría</h3>

                           <div class="space-y-4">
                               @include('audit::partials.audit-message-stack', [
                               'title' => 'Cálculo aritmético',
                               'items' => $arithmeticCoherence,
                           ])
                               @include('audit::partials.audit-message-stack', [
                             'title' => 'Seguridad social',
                             'items' => $socialSecurityCoherence,
                         ])
                               @include('audit::partials.audit-message-stack', [
                             'title' => 'Heurísticas de estructura',
                             'items' => $heuristicIntegrity,
                         ])
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
