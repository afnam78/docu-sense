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
                <div class=" text-gray-900">
                    <div class="grid grid-cols-2 gap-2 items-start">
                        <div class="border rounded shadow bg-white p-4">
                            <div class="mb-4">
                                <h3 class="text-lg font-medium">Datos extraídos</h3>
                            </div>
                            <div class="space-y-4">
                                @foreach($payslip as $key => $value)
                                    @include('audit::partials.payslip-stack', [
                             'title' => $key,
                             'items' => $value,
                         ])
                                @endforeach
                            </div>
                        </div>
                        <div class="border rounded shadow bg-white p-4">
                            <div class="mb-4">
                                <h3 class="text-lg font-medium">Auditoría</h3>
                            </div>

                            <div class="space-y-4">
                                @include('audit::partials.audit-message-stack', [
                                'title' => 'Integridad de Datos Aritméticos',
                                'items' => $arithmeticCoherence,
                            ])
                                @include('audit::partials.audit-message-stack', [
                              'title' => 'Coherencia Normativa (Fiscal/SS)',
                              'items' => $socialSecurityCoherence,
                          ])
                                @include('audit::partials.audit-message-stack', [
                              'title' => 'Smart Check: Heurísticas de Confianza',
                              'items' => $heuristicIntegrity,
                          ])

                                @if(!empty($fieldsSanity))
                                    @include('audit::partials.audit-message-stack', [
                                  'title' => 'Campos vacíos',
                                  'items' => $fieldsSanity,
                                  ])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
