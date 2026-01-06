<div class="container mx-auto px-4">
    <div class="mx-auto max-w-3xl text-center"><h2
            class="font-headline text-3xl font-bold tracking-tight sm:text-4xl">El Motor de Auditoría de Tres
            Capas</h2>
        <p class="mt-4 text-lg text-muted">Nuestro corazón es un motor de discrepancias construido sobre
            principios DDD. Está diseñado para capturar todo, desde errores de redondeo hasta fraudes sofisticados,
            garantizando una integridad de datos absoluta.</p></div>
    <div class="mx-auto mt-16 max-w-4xl">
        <div class="w-full">
            <div class="border-b" x-data="{ expanded: false }">
                <h3 class="flex">
                    <button @click="expanded = ! expanded" type="button"
                            class="flex flex-1 items-center justify-between py-4 font-medium transition-all  text-lg font-headline hover:no-underline">
                        <div class="flex items-center gap-4 font-headline"><span class="text-2xl">🔢</span>Capa A: Integridad
                            Aritmética
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round"
                             class="lucide lucide-chevron-down h-4 w-4 shrink-0 transition-transform duration-200">
                            <path d="m6 9 6 6 6-6"></path>
                        </svg>
                    </button>
                </h3>
                <div x-show="expanded" x-collapse class="overflow-hidden text-sm transition-all pb-5">
                    <p class="text-muted">
                        Esta capa realiza una comprobación fundamental de las matemáticas de la nómina. Verifica que la
                        suma
                        de todos los devengos (Total Devengado) menos la suma de todas las deducciones (Total
                        Deducciones)
                        sea igual al salario neto final (Líquido Total). Cualquier desajuste, incluso un error de
                        redondeo,
                        es señalado. Esto asegura que el documento sea internamente consistente desde un punto de vista
                        puramente numérico.
                    </p>
                </div>
            </div>
            <div class="border-b" x-data="{ expanded: false }">
                <h3 class="flex" @click="expanded = ! expanded">
                    <button type="button"
                            class="flex flex-1 items-center justify-between py-4 font-medium transition-all  text-lg font-headline hover:no-underline">
                        <div class="flex items-center gap-4 font-headline"><span class="text-2xl">⚖️</span>Capa B: Coherencia
                            Fiscal
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round"
                             class="lucide lucide-chevron-down h-4 w-4 shrink-0 transition-transform duration-200">
                            <path d="m6 9 6 6 6-6"></path>
                        </svg>
                    </button>
                </h3>
                <div class="overflow-hidden text-sm transition-all pb-5" x-show="expanded" x-collapse>
                    <p class="text-muted">
                        Esta capa cruza las cifras extraídas con las regulaciones legales y fiscales conocidas.
                        Comprueba si el porcentaje de retención de IRPF es plausible para el tramo salarial
                        correspondiente. Verifica que las cotizaciones a la Seguridad Social, como las contingencias
                        comunes (4.70%) y el mecanismo MEI, se calculan correctamente sobre las bases de cotización.
                        Esto detecta inconsistencias que podrían indicar evasión fiscal o errores de cálculo.
                    </p>
                </div>
            </div>
            <div class="border-b" x-data="{ expanded: false }">
                <h3 class="flex" @click="expanded = ! expanded">
                    <button type="button"
                            class="flex flex-1 items-center justify-between py-4 font-medium transition-all  text-lg font-headline hover:no-underline">
                        <div class="flex items-center gap-4 font-headline"><span class="text-2xl">🤖</span>Capa C: Anti-Alucinación
                            por IA
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round"
                             class="lucide lucide-chevron-down h-4 w-4 shrink-0 transition-transform duration-200">
                            <path d="m6 9 6 6 6-6"></path>
                        </svg>
                    </button>
                </h3>
                <div class="overflow-hidden text-sm transition-all pb-5" x-show="expanded" x-collapse>
                    <p class="text-muted">
                        Esta capa heurística avanzada actúa como una comprobación de cordura sobre la propia salida de
                        la IA. Valida el formato de identificadores críticos como los números NIF/CIF. Asegura que las
                        fechas del período de la nómina sean lógicas (por ejemplo, que la fecha de fin sea posterior a
                        la de inicio). También utiliza el reconocimiento de patrones para detectar si la IA ha
                        "inventado" o "alucinado" datos que no se ajustan a las estructuras típicas de las nóminas,
                        evitando escenarios de "basura entra, basura sale".
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
