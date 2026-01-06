@php use Illuminate\Support\Facades\Auth; @endphp
<header
    class="sticky top-0 z-50 w-full border-b border-border/40 bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
    <div class="flex justify-center">
        <div class="h-14 flex container max-w-screen-2xl items-center mx-4">
            <div class="mr-4 flex items-center"><a class="mr-6 flex items-center space-x-2" href="/">
                    <x-application-logo class="size-6 text-primary"/>
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
            </div>
        </div>
    </div>
</header>
