<!-- resources/views/filament/pages/reporte-inventario.blade.php -->
<x-filament::page>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 to-violet-100 dark:from-gray-900 dark:to-gray-800 py-12 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-violet-700">
                    REPORTE DE INVENTARIO
                </h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 font-medium">
                    Estado completo de todos tus productos
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-violet-700 px-10 py-8 text-white text-center">
                    <h2 class="text-3xl font-bold">Inventario Actual del Sistema</h2>
                    <p class="mt-3 text-lg opacity-90">Reporte automático con alertas de stock bajo</p>
                </div>

                <div class="p-12 text-center">
                    <div class="bg-gradient-to-r from-purple-100 to-violet-100 dark:from-purple-900 dark:to-violet-900 rounded-2xl p-10 mb-10">
                        <p class="text-2xl font-bold text-purple-800 dark:text-purple-200">
                            Total de productos registrados en el sistema
                        </p>
                        <p class="text-5xl font-extrabold text-purple-900 dark:text-purple-100 mt-4">
                            {{ \App\Models\Producto::count() }}
                        </p>
                    </div>

                    <form wire:submit.prevent="generarPDF">
                        <button type="submit" class="inline-flex items-center px-16 py-6 bg-gradient-to-r from-purple-600 to-violet-700 hover:from-purple-700 hover:to-violet-800 text-white font-bold text-2xl rounded-3xl shadow-2xl transform hover:scale-110 transition-all duration-500">
                            GENERAR REPORTE COMPLETO
                        </button>
                    </form>

                    <div class="mt-10 text-gray-600 dark:text-gray-400">
                        <p class="text-lg">Reporte generado el: <strong>{{ now()->format('d \d\e F \d\e Y \a \l\a\s H:i') }}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament::page>