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
                                $slot = $booking->slot;
                                $lesson = $slot->lesson;
                            @endphp

                            <div class="rounded-xl p-5 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 transition hover:shadow-md"
                                 style="border: 1px solid var(--border); background: var(--bg-card);">
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

                                    @if ($booking->note)
                                        <div class="mt-3 text-sm rounded-lg p-2.5" style="background: #f8fafc; color: var(--text-secondary);">
                                            <span class="font-medium" style="color: var(--text-primary);">Nota:</span> {{ $booking->note }}
                                        </div>
                                    @endif
                                </div>

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('lessons.show', $lesson) }}"
                                       class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition hover:bg-gray-50"
                                       style="border: 1px solid var(--border); color: var(--text-primary);">
                                        Dettagli
                                    </a>

                                    @if ($booking->status !== 'cancelled')
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
