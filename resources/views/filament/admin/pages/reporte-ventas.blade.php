<!-- resources/views/filament/pages/reporte-ventas.blade.php -->
<x-filament::page>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 py-12 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Título Principal -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-700 dark:from-blue-400 dark:to-indigo-500">
                    REPORTE DE VENTAS
                </h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 font-medium">
                    Sistema de Gestión Pa'Consentir
                </p>
            </div>

            <!-- Tarjeta Principal -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-10 py-8 text-white">
                    <h2 class="text-2xl font-bold">Generar Reporte en PDF</h2>
                    <p class="mt-2 opacity-90">Selecciona el rango de fechas para descargar el reporte detallado</p>
                </div>

                <div class="p-10">
                    <form wire:submit.prevent="generarPDF" class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    Fecha de Inicio
                                </label>
                                <input 
                                    type="date" 
                                    wire:model.live="fecha_inicio"
                                    class="w-full px-5 py-4 text-lg border-2 border-gray-300 dark:border-gray-600 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900 dark:bg-gray-700 transition-all duration-300"
                                    required
                                />
                            </div>

                            <div class="space-y-3">
                                <label class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    Fecha de Fin
                                </label>
                                <input 
                                    type="date" 
                                    wire:model.live="fecha_fin"
                                    class="w-full px-5 py-4 text-lg border-2 border-gray-300 dark:border-gray-600 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900 dark:bg-gray-700 transition-all duration-300"
                                    required
                                />
                            </div>
                        </div>

                        <div class="text-center pt-6">
                            <button type="submit" class="inline-flex items-center px-12 py-5 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-bold text-xl rounded-2xl shadow-xl transform hover:scale-105 transition-all duration-300">
                                GENERAR REPORTE PDF
                            </button>
                        </div>
                    </form>

                    <div class="mt-10 p-6 bg-gray-50 dark:bg-gray-700 rounded-2xl text-center">
                        <p class="text-gray-600 dark:text-gray-300">
                            <strong>Período actual:</strong> 
                            {{ \Carbon\Carbon::parse($fecha_inicio)->format('d \d\e F \d\e Y') }} 
                            al 
                            {{ \Carbon\Carbon::parse($fecha_fin)->format('d \d\e F \d\e Y') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-10 text-gray-500 dark:text-gray-400 text-sm">
                <p>© {{ date('Y') }} Pa'Consentir • Todos los derechos reservados</p>
            </div>
        </div>
    </div>
</x-filament::page>