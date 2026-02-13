<x-guest-layout>
    <div class="mb-4 text-sm" style="color: #5a6c7d;">
        Grazie per esserti registrato! Prima di iniziare, potresti verificare il tuo indirizzo email cliccando sul link che ti abbiamo appena inviato? Se non hai ricevuto l'email, saremo felici di inviartene un'altra.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm" style="color: #10b981;">
            Un nuovo link di verifica è stato inviato all'indirizzo email fornito durante la registrazione.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    Invia nuovamente email di verifica
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#16697a]" style="color: #5a6c7d;" onmouseover="this.style.color='#16697a'" onmouseout="this.style.color='#5a6c7d'">
                Esci
            </button>
        </form>
    </div>
</x-guest-layout>
