<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans">
<header
    class="sticky top-0 z-50 w-full border-b border-border/40 bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
    <div class="flex justify-center">
        <div class="h-14 flex container max-w-screen-2xl items-center">
            <div class="mr-4 flex items-center"><a class="mr-6 flex items-center space-x-2" href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-shield-check h-6 w-6 text-primary">
                        <path
                            d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span class="font-bold font-headline">DocuSense</span></a>
                <nav class="hidden gap-6 md:flex"><a
                        class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground"
                        href="#features">Características</a><a
                        class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground"
                        href="#audit-logic">Lógica de Auditoría</a><a
                        class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground"
                        href="#stack">Tecnología</a></nav>
            </div>
            <div class="flex flex-1 items-center justify-end space-x-4"><a
                    class="inline-flex items-center justify-center gap-2 text-white whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-primary hover:bg-primary/90 h-10 px-4 py-2"
                    href="#demo">Solicitar Demo</a>
                <button
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-accent hover:text-accent h-10 w-10 md:hidden"
                    type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="radix-_R_56atmlb_"
                    data-state="closed">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-menu h-5 w-5">
                        <line x1="4" x2="20" y1="12" y2="12"></line>
                        <line x1="4" x2="20" y1="6" y2="6"></line>
                        <line x1="4" x2="20" y1="18" y2="18"></line>
                    </svg>
                    <span class="sr-only">Abrir Menú</span></button>
            </div>
        </div>
    </div>
</header>
<section class="relative w-full py-20 md:py-32 lg:py-40">
    <img
        alt="Abstract background with digital nodes and connections, representing technology and data."
        class="object-cover"
        style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" sizes="100vw"
        src="{{asset('images/photo-1644088379091-d574269d422f.webp')}}">
    <div class="absolute inset-0 bg-gradient-to-t from-background via-background/80 to-transparent"></div>
    <div class="container relative z-10 mx-auto px-4 text-center">
        <div class="mx-auto max-w-4xl"><h1
                class="font-headline text-4xl font-bold tracking-tight text-foreground sm:text-5xl lg:text-6xl">
                Auditoría de Nóminas con IA. <br><span class="text-primary">Realidad Financiera Incuestionable.</span>
            </h1>
            <p class="mt-6 text-lg leading-8 text-muted">DocuSense no es solo un OCR. Es un Auditor Contable
                Senior que mitiga el fraude y el error humano, asegurando que cada nómina sea matemática y legalmente
                sólida.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6"><a
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-white hover:bg-primary/90 h-11 rounded-md px-8"
                    href="#demo">Solicitar una Demo
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-arrow-right ml-2 h-5 w-5">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </a><a
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 hover:bg-accent hover:text-white h-11 rounded-md px-8"
                    href="#audit-logic">Conoce la Lógica</a></div>
            <div class="mt-8 flex justify-center gap-x-6 gap-y-2 flex-wrap">
                <div class="flex items-center gap-2 text-sm text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-circle-check-big h-4 w-4 text-accent">
                        <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                        <path d="m9 11 3 3L22 4"></path>
                    </svg>
                    Privacidad sin Almacenamiento
                </div>
                <div class="flex items-center gap-2 text-sm text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-circle-check-big h-4 w-4 text-accent">
                        <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                        <path d="m9 11 3 3L22 4"></path>
                    </svg>
                    Motor de Discrepancias Automatizado
                </div>
                <div class="flex items-center gap-2 text-sm text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-circle-check-big h-4 w-4 text-accent">
                        <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                        <path d="m9 11 3 3L22 4"></path>
                    </svg>
                    Mitigación de Fraude y Errores
                </div>
            </div>
        </div>
    </div>
</section>
<section id="features" class="w-full bg-secondary py-20 lg:py-28">
    <div class="container mx-auto px-4">
        <div class="mx-auto max-w-2xl text-center"><h2
                class="font-headline text-3xl font-bold tracking-tight sm:text-4xl">No Solo OCR. Inteligencia
                Financiera.</h2>
            <p class="mt-4 text-lg text-muted">DocuSense proporciona un nivel de escrutinio inigualable,
                convirtiendo documentos de nómina en datos financieros verificados en los que puedes confiar.</p></div>
        <div class="mt-16 grid grid-cols-1 gap-8 md:grid-cols-3">
            <div
                class="rounded-lg border text-card-foreground flex flex-col items-center text-center p-6 border-transparent shadow-lg hover:shadow-primary/20 transition-shadow duration-300 bg-white">
                <div class="flex flex-col space-y-1.5 p-6 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-calculator h-8 w-8 text-primary">
                        <rect width="16" height="20" x="4" y="2" rx="2"></rect>
                        <line x1="8" x2="16" y1="6" y2="6"></line>
                        <line x1="16" x2="16" y1="14" y2="18"></line>
                        <path d="M16 10h.01"></path>
                        <path d="M12 10h.01"></path>
                        <path d="M8 10h.01"></path>
                        <path d="M12 14h.01"></path>
                        <path d="M8 14h.01"></path>
                        <path d="M12 18h.01"></path>
                        <path d="M8 18h.01"></path>
                    </svg>
                    <div class="text-2xl font-semibold leading-none tracking-tight mt-4 font-headline">Auditoría
                        Automatizada de Nóminas
                    </div>
                </div>
                <div class="text-sm text-muted">Nuestro motor actúa como un contable senior, verificando cada
                    línea para asegurar su integridad matemática y legal, no solo leyendo texto.
                </div>
            </div>
            <div
                class="rounded-lg border text-card-foreground flex flex-col items-center text-center p-6 border-transparent shadow-lg hover:shadow-primary/20 transition-shadow duration-300 bg-white">
                <div class="flex flex-col space-y-1.5 p-6 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-search-slash h-8 w-8 text-primary">
                        <path d="m13.5 8.5-5 5"></path>
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </svg>
                    <div class="text-2xl font-semibold leading-none tracking-tight mt-4 font-headline">El Motor de
                        Discrepancias
                    </div>
                </div>
                <div class="text-sm text-muted">Ve más allá del OCR con una auditoría de tres capas que cruza
                    ingresos, deducciones y cotizaciones para detectar hasta el más sutil de los errores.
                </div>
            </div>
            <div
                class="rounded-lg border text-card-foreground flex flex-col items-center text-center p-6 border-transparent shadow-lg hover:shadow-primary/20 transition-shadow duration-300 bg-white">
                <div class="flex flex-col space-y-1.5 p-6 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-file-x h-8 w-8 text-primary">
                        <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                        <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                        <path d="m14.5 12.5-5 5"></path>
                        <path d="m9.5 12.5 5 5"></path>
                    </svg>
                    <div class="text-2xl font-semibold leading-none tracking-tight mt-4 font-headline">Privacidad Sin
                        Almacenamiento
                    </div>
                </div>
                <div class="text-sm text-muted">Privacidad por diseño. Procesamos documentos en memoria y
                    solo guardamos un hash SHA-256, garantizando que los archivos originales nunca se almacenan.
                </div>
            </div>
        </div>
    </div>
</section>
<section id="audit-logic" class="w-full py-20 lg:py-28">
    <div class="container mx-auto px-4">
        <div class="mx-auto max-w-3xl text-center"><h2
                class="font-headline text-3xl font-bold tracking-tight sm:text-4xl">El Motor de Auditoría de Tres
                Capas</h2>
            <p class="mt-4 text-lg text-muted">Nuestro corazón es un motor de discrepancias construido sobre
                principios DDD. Está diseñado para capturar todo, desde errores de redondeo hasta fraudes sofisticados,
                garantizando una integridad de datos absoluta.</p></div>
        <div class="mx-auto mt-16 max-w-4xl">
            <div class="w-full" data-orientation="vertical">
                <div data-state="closed" data-orientation="vertical" class="border-b">
                    <h3 data-orientation="vertical" data-state="closed" class="flex">
                        <button type="button" aria-controls="radix-_R_2pqatmlb_" aria-expanded="false"
                                data-state="closed" data-orientation="vertical" id="radix-_R_pqatmlb_"
                                class="flex flex-1 items-center justify-between py-4 font-medium transition-all [&amp;[data-state=open]&gt;svg]:rotate-180 text-lg font-headline hover:no-underline"
                                data-radix-collection-item="">
                            <div class="flex items-center gap-4"><span class="text-2xl">🔢</span>Capa A: Integridad
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
                    <div data-state="closed" id="radix-_R_2pqatmlb_" role="region" aria-labelledby="radix-_R_pqatmlb_"
                         data-orientation="vertical"
                         class="overflow-hidden text-sm transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down"
                         style="--radix-accordion-content-height: var(--radix-collapsible-content-height); --radix-accordion-content-width: var(--radix-collapsible-content-width); --radix-collapsible-content-height: 204px; --radix-collapsible-content-width: 896px;"
                         hidden=""></div>
                </div>
                <div data-state="closed" data-orientation="vertical" class="border-b">
                    <h3 data-orientation="vertical" data-state="closed" class="flex">
                        <button type="button" aria-controls="radix-_R_39qatmlb_" aria-expanded="false"
                                data-state="closed" data-orientation="vertical" id="radix-_R_19qatmlb_"
                                class="flex flex-1 items-center justify-between py-4 font-medium transition-all [&amp;[data-state=open]&gt;svg]:rotate-180 text-lg font-headline hover:no-underline"
                                data-radix-collection-item="">
                            <div class="flex items-center gap-4"><span class="text-2xl">⚖️</span>Capa B: Coherencia
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
                    <div data-state="closed" id="radix-_R_39qatmlb_" hidden="" role="region"
                         aria-labelledby="radix-_R_19qatmlb_" data-orientation="vertical"
                         class="overflow-hidden text-sm transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down"
                         style="--radix-accordion-content-height: var(--radix-collapsible-content-height); --radix-accordion-content-width: var(--radix-collapsible-content-width);"></div>
                </div>
                <div data-state="closed" data-orientation="vertical" class="border-b">
                    <h3 data-orientation="vertical" data-state="closed" class="flex">
                        <button type="button" aria-controls="radix-_R_3pqatmlb_" aria-expanded="false"
                                data-state="closed" data-orientation="vertical" id="radix-_R_1pqatmlb_"
                                class="flex flex-1 items-center justify-between py-4 font-medium transition-all [&amp;[data-state=open]&gt;svg]:rotate-180 text-lg font-headline hover:no-underline"
                                data-radix-collection-item="">
                            <div class="flex items-center gap-4"><span class="text-2xl">🤖</span>Capa C: Anti-Alucinación
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
                    <div data-state="closed" id="radix-_R_3pqatmlb_" hidden="" role="region"
                         aria-labelledby="radix-_R_1pqatmlb_" data-orientation="vertical"
                         class="overflow-hidden text-sm transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down"
                         style="--radix-accordion-content-height: var(--radix-collapsible-content-height); --radix-accordion-content-width: var(--radix-collapsible-content-width);"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="stack" class="w-full bg-secondary py-20 lg:py-28">
    <div class="container mx-auto px-4">
        <div class="mx-auto max-w-2xl text-center"><h2
                class="font-headline text-3xl font-bold tracking-tight sm:text-4xl">Construido Sobre Cimientos de
                Excelencia</h2>
            <p class="mt-4 text-lg text-muted">Utilizamos un stack tecnológico robusto, moderno y escalable
                para ofrecer fiabilidad y rendimiento.</p></div>
        <div class="mt-16 grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-5">
            <div
                class="rounded-lg border text-card-foreground flex flex-col items-center justify-center p-6 space-y-2 bg-white border-transparent shadow-md hover:shadow-primary/20 transition-shadow">
                <div class="h-12 w-12 text-muted flex items-center justify-center">
                    <svg class="h-full w-full fill-current" aria-label="Next.js logomark" role="img"
                         viewBox="0 0 180 180">
                        <mask id="a" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="180"
                              height="180">
                            <circle cx="90" cy="90" r="90" fill="#fff"></circle>
                        </mask>
                        <g mask="url(#a)">
                            <circle cx="90" cy="90" r="90" fill="currentColor"></circle>
                            <path
                                d="M149.53 167.53L63.22 81.21v73.22H49.53V32.47h13.69l86.31 86.32v-73.2h13.69v121.94h-13.69z"
                                fill="#fff"></path>
                        </g>
                    </svg>
                </div>
                <p class="font-semibold text-sm">Next.js</p></div>
            <div
                class="rounded-lg border text-card-foreground flex flex-col items-center justify-center p-6 space-y-2 bg-white border-transparent shadow-md hover:shadow-primary/20 transition-shadow">
                <div class="h-12 w-12 text-muted flex items-center justify-center">
                    <svg class="h-full w-full fill-current" aria-label="React logomark" role="img"
                         viewBox="-11.5 -10.23174 23 20.46348">
                        <circle cx="0" cy="0" r="2.05" fill="currentColor"></circle>
                        <g stroke="currentColor" stroke-width="1" fill="none">
                            <ellipse rx="11" ry="4.2"></ellipse>
                            <ellipse rx="11" ry="4.2" transform="rotate(60)"></ellipse>
                            <ellipse rx="11" ry="4.2" transform="rotate(120)"></ellipse>
                        </g>
                    </svg>
                </div>
                <p class="font-semibold text-sm">React</p></div>
            <div
                class="rounded-lg border text-card-foreground flex flex-col items-center justify-center p-6 space-y-2 bg-white border-transparent shadow-md hover:shadow-primary/20 transition-shadow">
                <div class="h-12 w-12 text-muted flex items-center justify-center">
                    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                         class="h-full w-full fill-current"><title>Tailwind CSS</title>
                        <path
                            d="M12.001,4.8c-3.2,0-5.2,1.6-6,4.8c1.2-1.6,2.6-2.2,4.2-1.8c0.913,0.228,1.565,0.89,2.288,1.624 C13.666,10.618,15.027,12,18.001,12c3.2,0,5.2-1.6,6-4.8c-1.2,1.6-2.6,2.2-4.2,1.8c-0.913-0.228-1.565-0.89-2.288-1.624 C16.334,6.182,14.973,4.8,12.001,4.8z M6.001,12c-3.2,0-5.2,1.6-6,4.8c1.2-1.6,2.6-2.2,4.2-1.8c0.913,0.228,1.565,0.89,2.288,1.624 c1.177,1.194,2.538,2.576,5.512,2.576c3.2,0,5.2-1.6,6-4.8c-1.2,1.6-2.6,2.2-4.2,1.8c-0.913-0.228-1.565-0.89-2.288-1.624 C10.334,13.382,8.973,12,6.001,12z"></path>
                    </svg>
                </div>
                <p class="font-semibold text-sm">Tailwind CSS</p></div>
            <div
                class="rounded-lg border text-card-foreground flex flex-col items-center justify-center p-6 space-y-2 bg-white border-transparent shadow-md hover:shadow-primary/20 transition-shadow">
                <div class="h-12 w-12 text-muted flex items-center justify-center">
                    <div class="font-bold font-headline text-xl tracking-tighter">Genkit</div>
                </div>
                <p class="font-semibold text-sm">Genkit</p></div>
            <div
                class="rounded-lg border text-card-foreground flex flex-col items-center justify-center p-6 space-y-2 bg-white border-transparent shadow-md hover:shadow-primary/20 transition-shadow">
                <div class="h-12 w-12 text-muted flex items-center justify-center">
                    <div class="font-bold font-headline text-3xl">DDD</div>
                </div>
                <p class="font-semibold text-sm">DDD</p></div>
        </div>
    </div>
</section>
<section id="demo" class="w-full py-20 lg:py-28 bg-contact">
    <div class="container mx-auto px-4">
        <div class="rounded-lg border bg-white text-card-foreground max-w-2xl mx-auto shadow-lg">
            <div class="flex flex-col space-y-1.5 p-6 text-center">
                <div class="font-semibold tracking-tight font-headline text-3xl">¿Listo para Ver DocuSense en Acción?
                </div>
                <div class="text-sm text-muted">Rellena el formulario para programar una demostración
                    personalizada con nuestro equipo.
                </div>
            </div>
            <div class="p-6 pt-0">
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2"><label
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                for="_R_4qqatmlb_-form-item">Nombre Completo</label><input
                                class="flex h-10 w-full rounded-md border border-input bg-contact px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                placeholder="John Doe" id="_R_4qqatmlb_-form-item"
                                aria-describedby="_R_4qqatmlb_-form-item-description" aria-invalid="false" name="name"
                                value=""></div>
                        <div class="space-y-2"><label
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                for="_R_8qqatmlb_-form-item">Nombre de la Empresa</label><input
                                class="flex h-10 w-full rounded-md border border-input bg-contact px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                placeholder="Acme Inc." id="_R_8qqatmlb_-form-item"
                                aria-describedby="_R_8qqatmlb_-form-item-description" aria-invalid="false"
                                name="company" value=""></div>
                    </div>
                    <div class="space-y-2"><label
                            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                            for="_R_1aqatmlb_-form-item">Email de Trabajo</label><input
                            class="flex h-10 w-full rounded-md border border-input bg-contact px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                            placeholder="tu@empresa.com" id="_R_1aqatmlb_-form-item"
                            aria-describedby="_R_1aqatmlb_-form-item-description" aria-invalid="false" name="email"
                            value=""></div>
                    <div class="space-y-2"><label
                            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                            for="_R_1qqatmlb_-form-item">Mensaje (Opcional)</label><textarea
                            class="flex min-h-[80px] w-full rounded-md border border-input bg-contact px-3 py-2 text-base ring-offset-background placeholder:text-muted focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                            placeholder="Cuéntanos sobre tus necesidades específicas..." name="message"
                            id="_R_1qqatmlb_-form-item" aria-describedby="_R_1qqatmlb_-form-item-description"
                            aria-invalid="false"></textarea></div>
                    <button
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-white hover:bg-primary/90 h-10 px-4 py-2 w-full"
                        type="submit">Solicitar Demo
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
<footer class="w-full border-t border-border/40">
    <div class="container mx-auto flex h-16 items-center justify-between px-4">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="lucide lucide-shield-check h-5 w-5 text-muted-foreground">
                <path
                    d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path>
                <path d="m9 12 2 2 4-4"></path>
            </svg>
            <p class="text-sm text-muted-foreground font-headline">DocuSense</p></div>
        <p class="text-sm text-muted-foreground">© <!-- -->2026<!-- --> DocuSense. Todos los derechos reservados.</p>
    </div>
</footer>
</body>
</html>
