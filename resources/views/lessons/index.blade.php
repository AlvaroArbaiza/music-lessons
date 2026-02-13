<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl leading-tight" style="color: var(--text-primary);">
                    {{ __('Catalogo lezioni') }}
                </h2>
                <p class="text-sm mt-0.5" style="color: var(--text-secondary);">Scopri e prenota le lezioni disponibili</p>
            </div>

            <a href="{{ route('bookings.index') }}"
               class="btn-primary inline-flex items-center px-4 py-2.5 rounded-lg text-sm font-medium">
                Le mie prenotazioni
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
                @if ($lessons->count() === 0)
                    <div class="rounded-lg border-2 border-dashed p-12 text-center" style="border-color: var(--border);">
                        <div class="text-5xl mb-3">🎼</div>
                        <p class="text-lg font-medium" style="color: var(--text-primary);">Nessuna lezione disponibile</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @foreach ($lessons as $lesson)
                            <div class="rounded-xl p-5 transition hover:shadow-lg"
                                 style="border: 1px solid var(--border); background: var(--bg-card);">
                                <div class="flex items-start justify-between gap-4 mb-3">
                                    <div class="flex-1">
                                        <a href="{{ route('lessons.show', $lesson) }}"
                                           class="text-lg font-semibold hover:underline inline-block mb-1"
                                           style="color: var(--primary);">
                                            {{ $lesson->title }}
                                        </a>
                                        <p class="text-sm" style="color: var(--text-secondary);">
                                            Docente: <span class="font-semibold" style="color: var(--text-primary);">{{ $lesson->teacher_name }}</span>
                                        </p>
                                    </div>

                                    <span class="badge-info inline-flex items-center rounded-full px-3 py-1.5 text-xs font-semibold shrink-0">
                                        {{ strtoupper($lesson->instrument) }}
                                    </span>
                                </div>

                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="inline-flex items-center rounded-lg px-2.5 py-1 text-xs font-medium" style="background: #dbeafe; color: #1e40af;">
                                        📊 {{ $lesson->difficulty_level }}
                                    </span>
                                    <span class="inline-flex items-center rounded-lg px-2.5 py-1 text-xs font-medium" style="background: #f3e8ff; color: #6b21a8;">
                                        ⏱️ {{ $lesson->duration_minutes }} min
                                    </span>
                                </div>

                                @if ($lesson->description)
                                    <p class="text-sm line-clamp-2 mb-4" style="color: var(--text-secondary);">
                                        {{ $lesson->description }}
                                    </p>
                                @endif

                                <div class="pt-4" style="border-top: 1px solid var(--border);">
                                    <div class="flex items-center justify-between mb-3">
                                        <h4 class="text-sm font-semibold" style="color: var(--text-primary);">Prossimi slot</h4>
                                        <a href="{{ route('lessons.show', $lesson) }}"
                                           class="text-sm font-medium hover:underline"
                                           style="color: var(--primary);">
                                            Vedi tutti →
                                        </a>
                                    </div>

                                    @php
                                        $slots = $lesson->lessonSlots;
                                    @endphp

                                    @if ($slots->count() === 0)
                                        <p class="text-sm text-center py-3" style="color: var(--text-secondary);">Nessuno slot disponibile</p>
                                    @else
                                        <div class="space-y-2">
                                            @foreach ($slots->take(3) as $slot)
                                                @php
                                                    $capacity = (int) ($slot->max_students ?? 1);
                                                    $booked = (int) ($slot->confirmed_bookings_count ?? 0);
                                                    $remaining = max(0, $capacity - $booked);
                                                @endphp

                                                <div class="flex items-center justify-between rounded-lg px-3 py-2.5 transition hover:shadow-sm"
                                                     style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                                    <div class="flex items-center gap-1.5 text-sm" style="color: var(--text-primary);">
                                                        <span>📅</span>
                                                        <span class="font-medium">{{ $slot->starts_at->format('d/m H:i') }}</span>
                                                        <span style="color: var(--text-secondary);">→</span>
                                                        <span class="font-medium">{{ $slot->ends_at->format('H:i') }}</span>
                                                    </div>

                                                    <div class="text-xs font-medium" style="color: var(--text-secondary);">
                                                        <span class="font-semibold" style="color: var(--primary);">{{ $remaining }}</span>/{{ $capacity }} posti
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        @if ($slots->count() > 3)
                                            <p class="mt-2 text-xs text-center" style="color: var(--text-secondary);">
                                                + altri {{ $slots->count() - 3 }} slot disponibili
                                            </p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $lessons->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
