<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl leading-tight" style="color: var(--text-primary);">
                    {{ $lesson->title }}
                </h2>
                <p class="text-sm mt-0.5" style="color: var(--text-secondary);">
                    Docente: <span class="font-semibold" style="color: var(--text-primary);">{{ $lesson->teacher_name }}</span>
                </p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('lessons.index') }}"
                   class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium transition hover:bg-gray-50"
                   style="border: 1px solid var(--border); color: var(--text-primary);">
                    ← Catalogo
                </a>
                <a href="{{ route('bookings.index') }}"
                   class="btn-primary inline-flex items-center px-4 py-2.5 rounded-lg text-sm font-medium">
                    Le mie prenotazioni
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
                <div class="mb-6 rounded-lg p-4 badge-success" style="border: 1px solid #86efac;">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-lg p-4 badge-danger" style="border: 1px solid #fecaca;">
                    <div class="font-semibold mb-2">Errore</div>
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Info lezione --}}
                <div class="lg:col-span-1">
                    <div class="card p-6">
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="inline-flex items-center rounded-lg px-2.5 py-1.5 text-xs font-semibold" style="background: #dbeafe; color: #1e40af;">
                                🎸 {{ strtoupper($lesson->instrument) }}
                            </span>
                            <span class="inline-flex items-center rounded-lg px-2.5 py-1.5 text-xs font-semibold" style="background: #f3e8ff; color: #6b21a8;">
                                📊 {{ $lesson->difficulty_level }}
                            </span>
                            <span class="badge-info inline-flex items-center rounded-lg px-2.5 py-1.5 text-xs font-semibold">
                                ⏱️ {{ $lesson->duration_minutes }} min
                            </span>
                        </div>

                        @if ($lesson->description)
                            <div>
                                <h3 class="text-sm font-semibold mb-2" style="color: var(--text-primary);">Descrizione</h3>
                                <p class="text-sm leading-relaxed" style="color: var(--text-secondary);">
                                    {{ $lesson->description }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Slot --}}
                <div class="lg:col-span-2">
                    <div class="card p-6">
                        <div class="flex items-center justify-between mb-5">
                            <h3 class="text-lg font-semibold" style="color: var(--text-primary);">Slot disponibili</h3>
                            <span class="badge-info rounded-full px-3 py-1 text-xs font-semibold">
                                {{ $lesson->slots->count() }} slot
                            </span>
                        </div>

                        @if ($lesson->slots->count() === 0)
                            <div class="rounded-lg border-2 border-dashed p-12 text-center" style="border-color: var(--border);">
                                <div class="text-5xl mb-3">📅</div>
                                <p class="text-lg font-medium" style="color: var(--text-primary);">Nessuno slot disponibile</p>
                            </div>
                        @else
                            <div class="space-y-3">
                                @foreach ($lesson->slots as $slot)
                                    @php
                                        $capacity = (int) $slot->max_students;
                                        $booked = (int) ($slot->confirmed_bookings_count ?? 0);
                                        $remaining = max(0, $capacity - $booked);
                                        $isFull = $remaining <= 0;
                                    @endphp

                                    <div class="rounded-xl p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 transition hover:shadow-md"
                                         style="border: 1px solid var(--border); background: var(--bg-card);">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-1.5 text-sm font-medium mb-2" style="color: var(--text-primary);">
                                                <span>📅</span>
                                                <span>{{ $slot->starts_at->format('d/m/Y H:i') }}</span>
                                                <span style="color: var(--text-secondary);">→</span>
                                                <span>{{ $slot->ends_at->format('H:i') }}</span>
                                            </div>

                                            <div class="flex items-center gap-2 text-xs">
                                                <span style="color: var(--text-secondary);">
                                                    Posti disponibili:
                                                    <span class="font-semibold" style="color: var(--primary);">{{ $remaining }}</span>/{{ $capacity }}
                                                </span>

                                                @if ($isFull)
                                                    <span class="badge-danger inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold">
                                                        Esaurito
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Prenota --}}
                                        <div class="flex items-center gap-2">
                                            @auth
                                                @if (!$isFull)
                                                    <form method="POST" action="{{ route('bookings.store') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full sm:w-auto">
                                                        @csrf
                                                        <input type="hidden" name="lesson_slot_id" value="{{ $slot->id }}">

                                                        <input type="text"
                                                               name="note"
                                                               placeholder="Nota (opzionale)"
                                                               class="w-full sm:w-52 rounded-lg text-sm transition"
                                                               style="border: 1px solid var(--border); padding: 0.5rem 0.75rem;"
                                                               value="{{ old('note') }}">

                                                        <button type="submit"
                                                                class="btn-primary inline-flex items-center justify-center px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap">
                                                            Prenota
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-sm" style="color: var(--text-secondary);">Non prenotabile</span>
                                                @endif
                                            @else
                                                <a href="{{ route('login') }}"
                                                   class="btn-primary inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium">
                                                    Login per prenotare
                                                </a>
                                            @endauth
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-5 rounded-lg p-3 text-xs" style="background: #f8fafc; color: var(--text-secondary);">
                                💡 <span class="font-medium">Nota:</span> Se hai un conflitto orario o lo slot è pieno, la prenotazione viene rifiutata automaticamente.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
