<!-- resources/views/filament/pages/dashboard.blade.php -->
<x-filament::page>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-purple-900 dark:to-pink-900">
        <div class="container mx-auto px-6 py-12">
            <!-- Título Principal -->
            <div class="text-center mb-12 animate-fade-in">
                <h1 class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600">
                    PA' CONSENTIR
                </h1>
                <p class="text-2xl font-light text-gray-700 dark:text-gray-300 mt-4">
                    Panel de Control • {{ now()->format('d \d\e F \d\e Y') }}
                </p>
            </div>

            <!-- Tarjetas Principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Ventas del Día -->
                <div class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white p-8 shadow-2xl transform hover:scale-105 transition-all duration-500">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <h3 class="text-xl font-bold opacity-90">VENTAS HOY</h3>
                    <p class="text-5xl font-black mt-4">{{ $ventasHoy }}</p>
                    <p class="text-2xl mt-2">Bs {{ number_format($totalVentasHoy, 2) }}</p>
                </div>

                <!-- Compras del Día -->
                <div class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-500 to-teal-600 text-white p-8 shadow-2xl transform hover:scale-105 transition-all duration-500">
                    <h3 class="text-xl font-bold opacity-90">COMPRAS HOY</h3>
                    <p class="text-5xl font-black mt-4">{{ $comprasHoy }}</p>
                    <p class="text-2xl mt-2">Bs {{ number_format($totalComprasHoy, 2) }}</p>
                </div>

                <!-- Productos Críticos -->
                <div class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-red-500 to-rose-600 text-white p-8 shadow-2xl transform hover:scale-105 transition-all duration-500">
                    <h3 class="text-xl font-bold opacity-90">STOCK CRÍTICO</h3>
                    <p class="text-6xl font-black mt-4">{{ $productosCriticos->count() }}</p>
                    <p class="text-lg mt-2">Productos por debajo del mínimo</p>
                </div>

                <!-- Total Productos -->
                <div class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-purple-500 to-violet-600 text-white p-8 shadow-2xl transform hover:scale-105 transition-all duration-500">
                    <h3 class="text-xl font-bold opacity-90">EN INVENTARIO</h3>
                    <p class="text-6xl font-black mt-4">{{ \App\Models\Producto::count() }}</p>
                    <p class="text-lg mt-2">Productos registrados</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <!-- Top 5 Platos Más Vendidos -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-8 border border-gray-200 dark:border-gray-700">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-6 text-center">
                        TOP 5 PLATOS MÁS VENDIDOS (30 DÍAS)
                    </h2>
                    <div class="space-y-5">
                        @foreach($topPlatos as $i => $plato)
                        <div class="flex items-center justify-between p-5 rounded-2xl bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900 dark:to-purple-900 transform hover:scale-105 transition-all">
                            <div class="flex items-center space-x-4">
                                <span class="text-4xl font-black text-indigo-600 dark:text-indigo-400">
                                    {{ $i + 1 }}
                                </span>
                                <div>
                                    <p class="text-xl font-bold text-gray-800 dark:text-white">{{ $plato->nombre }}</p>
                                </div>
                            </div>
                            <p class="text-3xl font-black text-indigo-600 dark:text-indigo-400">
                                {{ $plato->total }}
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Stock Crítico -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-8 border border-gray-200 dark:border-gray-700">
                    <h2 class="text-3xl font-bold text-red-600 dark:text-red-400 mb-6 text-center">
                        ALERTA: STOCK BAJO
                    </h2>
                    @if($productosCriticos->count() > 0)
                    <div class="space-y-4 max-h-96 overflow-y-auto">
                        @foreach($productosCriticos as $p)
                        <div class="flex justify-between items-center p-5 rounded-2xl bg-red-50 dark:bg-red-900/30 border-2 border-red-200 dark:border-red-800">
                            <div>
                                <p class="font-bold text-lg text-red-700 dark:text-red-300">{{ $p->nombre }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Actual: {{ number_format($p->cnt_actual, 2) }} {{ $p->undmedida?->nombre ?? '' }}
                                    | Mínimo: {{ number_format($p->cnt_minima, 2) }}
                                </p>
                            </div>
                            <span class="text-4xl animate-pulse">⚠️</span>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-center text-2xl text-green-600 dark:text-green-400 font-bold py-20">
                        ¡Excelente! Todo el inventario está en niveles óptimos
                    </p>
                    @endif
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-16 text-gray-500 dark:text-gray-400">
                <p class="text-lg font-medium">
                    Sistema Pa'Consentir © {{ date('Y') }} • Desarrollado con ❤️ para tu catering
                </p>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .animate-fade-in { animation: fadeIn 1s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
    @endpush
</x-filament::page>s