<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl leading-tight" style="color: var(--text-primary);">
                    {{ __('Le mie prenotazioni') }}
                </h2>
                <p class="text-sm mt-0.5" style="color: var(--text-secondary);">Gestisci e visualizza le tue lezioni prenotate</p>
            </div>

            <a href="{{ route('lessons.index') }}"
               class="btn-primary inline-flex items-center px-4 py-2.5 rounded-lg text-sm font-medium">
                + Prenota una lezione
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-6 rounded-lg p-4 badge-success" style="border: 1px solid #86efac;">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card p-6">
                @if ($bookings->count() === 0)
                    <div class="rounded-lg border-2 border-dashed p-12 text-center" style="border-color: var(--border);">
                        <div class="text-5xl mb-3">🎵</div>
                        <p class="text-lg font-medium mb-2" style="color: var(--text-primary);">Nessuna prenotazione</p>
                        <p class="mb-6" style="color: var(--text-secondary);">Inizia a prenotare le tue lezioni di musica</p>
                        <a href="{{ route('lessons.index') }}"
                           class="btn-primary inline-flex items-center px-5 py-2.5 rounded-lg text-sm font-medium">
                            Vai al catalogo
                        </a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($bookings as $booking)
                            @php
                                $slot = $booking->lessonSlot;
                                $lesson = $slot->lesson;
                            @endphp

                            <div class="rounded-xl p-5 flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4 transition hover:shadow-md"
                                 style="border: 1px solid var(--border); background: var(--bg-card);"
                                 x-data="{ editingNote: false }">
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-2 flex-wrap mb-2">
                                        <a href="{{ route('lessons.show', $lesson) }}"
                                           class="text-lg font-semibold hover:underline"
                                           style="color: var(--primary);">
                                            {{ $lesson->title }}
                                        </a>

                                        <span class="badge-info inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold">
                                            {{ strtoupper($lesson->instrument) }}
                                        </span>

                                        @if ($booking->status === 'cancelled')
                                            <span class="badge-danger inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold">
                                                ANNULLATA
                                            </span>
                                        @else
                                            <span class="badge-success inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold">
                                                CONFERMATA
                                            </span>
                                        @endif
                                    </div>

                                    <div class="text-sm mb-2" style="color: var(--text-secondary);">
                                        Docente: <span class="font-semibold" style="color: var(--text-primary);">{{ $lesson->teacher_name }}</span>
                                    </div>

                                    <div class="flex items-center gap-1.5 text-sm" style="color: var(--text-primary);">
                                        <span>📅</span>
                                        <span class="font-medium">{{ $slot->starts_at->format('d/m/Y H:i') }}</span>
                                        <span style="color: var(--text-secondary);">→</span>
                                        <span class="font-medium">{{ $slot->ends_at->format('H:i') }}</span>
                                    </div>

                                    {{-- Visualizza nota esistente --}}
                                    <div x-show="!editingNote" class="mt-3">
                                        @if ($booking->note)
                                            <div class="text-sm rounded-lg p-2.5" style="background: #f8fafc; color: var(--text-secondary);">
                                                <span class="font-medium" style="color: var(--text-primary);">Nota:</span> {{ $booking->note }}
                                            </div>
                                        @else
                                            <p class="text-sm italic" style="color: var(--text-secondary);">Nessuna nota</p>
                                        @endif
                                    </div>

                                    {{-- Form modifica nota --}}
                                    <div x-show="editingNote" x-cloak class="mt-3">
                                        <form method="POST" action="{{ route('bookings.update', $booking) }}" class="space-y-2">
                                            @csrf
                                            @method('PATCH')
                                            <div>
                                                <label for="note_{{ $booking->id }}" class="block text-sm font-medium mb-1" style="color: var(--text-primary);">Modifica nota</label>
                                                <textarea
                                                    id="note_{{ $booking->id }}"
                                                    name="note"
                                                    rows="2"
                                                    maxlength="500"
                                                    class="w-full rounded-lg text-sm border-gray-300 focus:border-[#16697a] focus:ring-[#16697a]"
                                                    placeholder="Aggiungi una nota (opzionale)">{{ old('note', $booking->note) }}</textarea>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <button type="submit"
                                                        class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium text-white transition"
                                                        style="background: linear-gradient(135deg, #16697a, #124f5d);">
                                                    Salva
                                                </button>
                                                <button type="button"
                                                        @click="editingNote = false"
                                                        class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium transition"
                                                        style="border: 1px solid var(--border); color: var(--text-secondary);"
                                                        onmouseover="this.style.backgroundColor='#f8f9fb'"
                                                        onmouseout="this.style.backgroundColor='transparent'">
                                                    Annulla
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="flex flex-wrap items-center gap-2 shrink-0">
                                    <a href="{{ route('lessons.show', $lesson) }}"
                                       class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition hover:bg-gray-50"
                                       style="border: 1px solid var(--border); color: var(--text-primary);">
                                        Dettagli
                                    </a>

                                    @if ($booking->status !== 'cancelled')
                                        <button type="button"
                                                @click="editingNote = !editingNote"
                                                class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition"
                                                style="border: 1px solid var(--border); color: var(--text-primary);"
                                                onmouseover="this.style.backgroundColor='#f8f9fb'"
                                                onmouseout="this.style.backgroundColor='transparent'">
                                            <span x-text="editingNote ? 'Chiudi' : 'Modifica nota'"></span>
                                        </button>

                                        <form method="POST" action="{{ route('bookings.destroy', $booking) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-white transition hover:opacity-90"
                                                    style="background: var(--accent-danger);"
                                                    onclick="return confirm('Vuoi annullare questa prenotazione?')">
                                                Annulla
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $bookings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
