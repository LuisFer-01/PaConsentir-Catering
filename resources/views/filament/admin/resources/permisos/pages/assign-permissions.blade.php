{{-- resources/views/filament/admin/resources/permiso-resource/pages/assign-permissions.blade.php --}}
<x-filament-panels::page>
    <form wire:submit.prevent="save">
        {{ $this->form }}

        @if($this->selectedRol)
            <div class="mt-6 space-x-2">
                {{ $this->getFormActions() }}
            </div>
        @endif
    </form>
</x-filament-panels::page>