<!-- resources/views/filament/pages/reporte-compras.blade.php -->
<x-filament::page>
    <div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-100 dark:from-gray-900 dark:to-gray-800 py-12 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-700">
                    REPORTE DE COMPRAS
                </h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 font-medium">
                    Control total de tus adquisiciones
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-emerald-700 px-10 py-8 text-white">
                    <h2 class="text-2xl font-bold">Reporte Detallado de Compras</h2>
                    <p class="mt-2 opacity-90">Incluye proveedor, productos y costos totales</p>
                </div>

                <div class="p-10">
                    <form wire:submit.prevent="generarPDF" class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-lg font-semibold text-gray-700 dark:text-gray-200">Desde</label>
                                <input type="date" wire:model.live="fecha_inicio" class="w-full px-5 py-4 text-lg border-2 border-gray-300 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-100 dark:bg-gray-700" required />
                            </div>
                            <div class="space-y-3">
                                <label class="text-lg font-semibold text-gray-700 dark:text-gray-200">Hasta</label>
                                <input type="date" wire:model.live="fecha_fin" class="w-full px-5 py-4 text-lg border-2 border-gray-300 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-100 dark:bg-gray-700" required />
                            </div>
                        </div>

                        <div class="text-center pt-6">
                            <button type="submit" class="px-12 py-5 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-bold text-xl rounded-2xl shadow-xl transform hover:scale-105 transition-all duration-300">
                                DESCARGAR REPORTE PDF
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-filament::page>