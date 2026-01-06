<div class="grid grid-cols-2 gap-2">
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
