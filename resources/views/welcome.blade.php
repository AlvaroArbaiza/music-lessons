<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Music Lessons | Prenotazioni lezioni</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, sans-serif;font-feature-settings:normal}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::-webkit-backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.relative{position:relative}.mx-auto{margin-left:auto;margin-right:auto}.mx-6{margin-left:1.5rem;margin-right:1.5rem}.ml-4{margin-left:1rem}.mt-16{margin-top:4rem}.mt-6{margin-top:1.5rem}.mt-4{margin-top:1rem}.-mt-px{margin-top:-1px}.mr-1{margin-right:0.25rem}.flex{display:flex}.inline-flex{display:inline-flex}.grid{display:grid}.h-16{height:4rem}.h-7{height:1.75rem}.h-6{height:1.5rem}.h-5{height:1.25rem}.min-h-screen{min-height:100vh}.w-auto{width:auto}.w-16{width:4rem}.w-7{width:1.75rem}.w-6{width:1.5rem}.w-5{width:1.25rem}.max-w-7xl{max-width:80rem}.shrink-0{flex-shrink:0}.scale-100{--tw-scale-x:1;--tw-scale-y:1;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.grid-cols-1{grid-template-columns:repeat(1, minmax(0, 1fr))}.items-center{align-items:center}.justify-center{justify-content:center}.gap-6{gap:1.5rem}.gap-4{gap:1rem}.self-center{align-self:center}.rounded-lg{border-radius:0.5rem}.rounded-full{border-radius:9999px}.bg-gray-100{--tw-bg-opacity:1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-red-50{--tw-bg-opacity:1;background-color:rgb(254 242 242 / var(--tw-bg-opacity))}.bg-dots-darker{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")}.from-gray-700\/50{--tw-gradient-from:rgb(55 65 81 / 0.5);--tw-gradient-to:rgb(55 65 81 / 0);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-transparent{--tw-gradient-to:rgb(0 0 0 / 0);--tw-gradient-stops:var(--tw-gradient-from), transparent, var(--tw-gradient-to)}.bg-center{background-position:center}.stroke-red-500{stroke:#ef4444}.stroke-gray-400{stroke:#9ca3af}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.text-center{text-align:center}.text-right{text-align:right}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-sm{font-size:0.875rem;line-height:1.25rem}.font-semibold{font-weight:600}.leading-relaxed{line-height:1.625}.text-gray-600{--tw-text-opacity:1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity:1;color:rgb(107 114 128 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-2xl{--tw-shadow:0 25px 50px -12px rgb(0 0 0 / 0.25);--tw-shadow-colored:0 25px 50px -12px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.shadow-gray-500\/20{--tw-shadow-color:rgb(107 114 128 / 0.2);--tw-shadow:var(--tw-shadow-colored)}.transition-all{transition-property:all;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.selection\:bg-red-500 *::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-red-500::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-gray-900:hover{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.hover\:text-gray-700:hover{--tw-text-opacity:1;color:rgb(55 65 81 / var(--tw-text-opacity))}.focus\:rounded-sm:focus{border-radius:0.125rem}.focus\:outline:focus{outline-style:solid}.focus\:outline-2:focus{outline-width:2px}.focus\:outline-red-500:focus{outline-color:#ef4444}.group:hover .group-hover\:stroke-gray-600{stroke:#4b5563}.z-10{z-index: 10}@media (prefers-reduced-motion: no-preference){.motion-safe\:hover\:scale-\[1\.01\]:hover{--tw-scale-x:1.01;--tw-scale-y:1.01;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}}@media (prefers-color-scheme: dark){.dark\:bg-gray-900{--tw-bg-opacity:1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:bg-gray-800\/50{background-color:rgb(31 41 55 / 0.5)}.dark\:bg-red-800\/20{background-color:rgb(153 27 27 / 0.2)}.dark\:bg-dots-lighter{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")}.dark\:bg-gradient-to-bl{background-image:linear-gradient(to bottom left, var(--tw-gradient-stops))}.dark\:stroke-gray-600{stroke:#4b5563}.dark\:text-gray-400{--tw-text-opacity:1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:shadow-none{--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.dark\:ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.dark\:ring-inset{--tw-ring-inset:inset}.dark\:ring-white\/5{--tw-ring-color:rgb(255 255 255 / 0.05)}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.group:hover .dark\:group-hover\:stroke-gray-400{stroke:#9ca3af}}@media (min-width: 640px){.sm\:fixed{position:fixed}.sm\:top-0{top:0px}.sm\:right-0{right:0px}.sm\:ml-0{margin-left:0px}.sm\:flex{display:flex}.sm\:items-center{align-items:center}.sm\:justify-center{justify-content:center}.sm\:justify-between{justify-content:space-between}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width: 768px){.md\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}}@media (min-width: 1024px){.lg\:gap-8{gap:2rem}.lg\:p-8{padding:2rem}}

            :root {
                --bg-a: #ede7e3;
                --bg-b: #f5f1ed;
                --ink: #2c3e50;
                --muted: #5a6c7d;
                --surface: rgba(255, 255, 255, 0.85);
                --surface-2: rgba(255, 255, 255, 0.70);
                --border: rgba(212, 205, 197, 0.8);
                --accent: #16697a;
                --accent-2: #489fb5;
                --accent-cyan: #82c0cc;
                --accent-orange: #ffa62b;
                --glow: rgba(22, 105, 122, 0.15);
            }

            .landing-bg {
                background: radial-gradient(1400px 600px at 70% -5%, rgba(130, 192, 204, 0.12), transparent 70%), linear-gradient(160deg, var(--bg-a), var(--bg-b));
                color: var(--ink);
            }

            .landing-bg::before {
                content: "";
                position: absolute;
                inset: 0;
                background-image: radial-gradient(circle at 1px 1px, rgba(212, 205, 197, 0.15) 1px, transparent 1px);
                background-size: 24px 24px;
                pointer-events: none;
            }

            .container {
                max-width: 1120px;
                margin: 0 auto;
                padding: 1.25rem;
                position: relative;
                z-index: 1;
            }

            .topbar,
            .hero,
            .panel,
            .footer {
                position: relative;
                z-index: 2;
            }

            .topbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 1rem;
                padding-top: 0.75rem;
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 0.7rem;
                font-size: 1.05rem;
                font-weight: 600;
            }

            .brand-mark {
                width: 2.4rem;
                height: 2.4rem;
                border-radius: 0.9rem;
                display: grid;
                place-items: center;
                background: linear-gradient(145deg, var(--accent), var(--accent-2));
                color: #fff;
                box-shadow: 0 12px 35px -10px var(--glow);
                font-size: 1.2rem;
                line-height: 1;
            }

            .hero {
                margin-top: 2rem;
                padding: 1.4rem;
                border-radius: 1.25rem;
                background: var(--surface);
                border: 1px solid var(--border);
                box-shadow: 0 10px 30px -15px rgba(22, 105, 122, 0.08);
                backdrop-filter: blur(12px);
            }

            .hero h1 {
                font-size: clamp(1.9rem, 4vw, 3rem);
                line-height: 1.1;
                letter-spacing: -0.02em;
                font-weight: 600;
                max-width: 18ch;
            }

            .hero p {
                margin-top: 0.95rem;
                max-width: 62ch;
                color: var(--muted);
            }

            .hero-glow {
                position: absolute;
                top: -2rem;
                right: 5%;
                width: 280px;
                height: 280px;
                border-radius: 999px;
                background: var(--glow);
                filter: blur(60px);
                opacity: 0.65;
                pointer-events: none;
            }

            .badge {
                display: inline-flex;
                align-items: center;
                gap: 0.4rem;
                border-radius: 999px;
                padding: 0.35rem 0.7rem;
                font-size: 0.8rem;
                font-weight: 600;
                background: color-mix(in srgb, var(--accent) 14%, transparent);
                color: var(--ink);
            }

            .dot {
                width: 0.45rem;
                height: 0.45rem;
                border-radius: 999px;
                background: var(--accent);
            }

            .actions {
                margin-top: 1.3rem;
                display: flex;
                flex-wrap: wrap;
                gap: 0.65rem;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 0.75rem;
                padding: 0.72rem 1rem;
                border: 1px solid transparent;
                font-weight: 600;
                transition: transform 140ms ease, box-shadow 140ms ease, background-color 140ms ease;
            }

            .btn:hover {
                transform: translateY(-1px);
            }

            .btn-primary {
                color: #fff;
                background: linear-gradient(135deg, var(--accent), var(--accent-2));
                box-shadow: 0 12px 28px -14px var(--glow);
            }

            .btn-secondary {
                color: var(--ink);
                background: var(--surface-2);
                border-color: var(--border);
            }

            .section {
                margin-top: 1.2rem;
            }

            .section h2 {
                font-size: 1.15rem;
                font-weight: 600;
                letter-spacing: -0.01em;
            }

            .grid-cards {
                margin-top: 0.8rem;
                display: grid;
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            .panel {
                padding: 1rem;
                border-radius: 1rem;
                background: var(--surface-2);
                border: 1px solid var(--border);
                box-shadow: 0 4px 12px -6px rgba(22, 105, 122, 0.08);
                transition: transform 140ms ease, box-shadow 140ms ease;
            }

            .panel:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px -8px rgba(22, 105, 122, 0.15);
            }

            .kicker {
                font-size: 0.79rem;
                text-transform: uppercase;
                letter-spacing: 0.08em;
                color: var(--muted);
            }

            .panel p {
                margin-top: 0.4rem;
                color: var(--muted);
                font-size: 0.92rem;
            }

            .footer {
                margin-top: 1.8rem;
                padding: 0.7rem 0 1.1rem;
                color: var(--muted);
                font-size: 0.85rem;
                display: flex;
                flex-direction: column;
                gap: 0.3rem;
            }

            @media (min-width: 720px) {
                .container {
                    padding: 1.5rem;
                }

                .hero {
                    padding: 2rem;
                    margin-top: 2.4rem;
                }

                .grid-steps {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }

                .grid-features {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .grid-slots {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }

                .footer {
                    flex-direction: row;
                    justify-content: space-between;
                }
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative min-h-screen overflow-hidden landing-bg selection:bg-red-500 selection:text-white">
            <div class="container">
                <div class="topbar">
                    <div class="brand">
                        <div class="brand-mark">♪</div>
                        <span>Music Lessons</span>
                    </div>
                </div>

                <section class="hero">
                    <div class="hero-glow"></div>
                    <span class="badge"><span class="dot"></span> Prenotazioni rapide</span>
                    <h1>Prenota lezioni di musica in pochi secondi</h1>
                    <p>Scegli la lezione, seleziona una fascia oraria disponibile e conferma.</p>

                    <div class="actions">
                        @auth
                            <a href="{{ route('lessons.index') }}" class="btn btn-primary">Vai al catalogo lezioni</a>
                            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Le mie prenotazioni</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Accedi</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-secondary">Crea account</a>
                            @endif
                        @endauth
                    </div>
                </section>

                <section class="section">
                    <h2>Come funziona</h2>
                    <div class="grid-cards grid-steps">
                        <article class="panel">
                            <div class="kicker">Step 1</div>
                            <h3>Scegli lezione</h3>
                            <p>Seleziona la lezione più adatta al tuo livello e obiettivo.</p>
                        </article>
                        <article class="panel">
                            <div class="kicker">Step 2</div>
                            <h3>Seleziona fascia oraria</h3>
                            <p>Visualizza gli slots disponibili e scegli l'orario migliore.</p>
                        </article>
                        <article class="panel">
                            <div class="kicker">Step 3</div>
                            <h3>Prenota</h3>
                            <p>Conferma in un clic e tieni traccia delle prenotazioni.</p>
                        </article>
                    </div>
                </section>

                <section class="section">
                    <h2>Cosa puoi fare</h2>

                    <div class="grid-cards grid-features">
                        <article class="panel">
                            <h3>Gestisci prenotazioni</h3>
                            <p>Controlla e aggiorna le tue prenotazioni senza passare da chat esterne.</p>
                        </article>
                        <article class="panel">
                            <h3>Calendario</h3>
                            <p>Vista ordinata delle lezioni per data e fascia oraria.</p>
                        </article>
                    </div>
                </section>

                <section class="section">
                    <h2>Prossime fasce orarie</h2>
                    @if ($upcomingSlots->count() > 0)
                        <div class="grid-cards grid-slots">
                            @foreach ($upcomingSlots as $slot)
                                @php
                                    $capacity = (int) $slot->max_students;
                                    $booked = (int) ($slot->confirmed_bookings_count ?? 0);
                                    $remaining = max(0, $capacity - $booked);
                                    $dayName = $slot->starts_at->locale('it')->isoFormat('dddd');
                                @endphp
                                <article class="panel">
                                    <div class="kicker">{{ ucfirst($dayName) }}</div>
                                    <h3>{{ $slot->starts_at->format('H:i') }} - {{ $slot->ends_at->format('H:i') }}</h3>
                                    <p>{{ $slot->lesson->instrument }} • {{ $remaining }} {{ $remaining === 1 ? 'posto libero' : 'posti liberi' }}</p>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div class="grid-cards">
                            <article class="panel" style="text-align: center; padding: 2rem;">
                                <p style="color: var(--muted);">Nessuno slot disponibile al momento</p>
                            </article>
                        </div>
                    @endif
                </section>

                <footer class="footer">
                    <div>© {{ date('Y') }} Music Lessons</div>
                    <div>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</div>
                </footer>
            </div>
        </div>
    </body>
</html>
