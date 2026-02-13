<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white border rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150', 'style' => 'border-color: #d4cdc5; color: #5a6c7d; focus-ring-color: #16697a;']) }} onmouseover="this.style.backgroundColor='#f8f9fb'" onmouseout="this.style.backgroundColor='white'">
    {{ $slot }}
</button>
