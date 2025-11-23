<div class="flex items-center gap-3">
    <img 
        src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : asset('storage/users/default-avatar-01.png') }}" 
        alt="Usuario" 
        class="w-12 h-12 rounded-full ring-4 ring-amber-500 shadow-xl object-cover"
    >
    <div class="text-left">
        <p class="text-lg font-bold text-white leading-tight">
            ¡Hola, {{ auth()->user()->name }}!
        </p>
        <p class="text-sm text-amber-300 font-medium">
            {{ auth()->user()->rol?->nombre ?? 'Usuario' }}
        </p>
    </div>
</div>