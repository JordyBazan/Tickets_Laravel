<x-app-layout>
    <style>
        #chartjs-tooltip {
            opacity: 1;
            position: absolute;
            background: rgba(255, 255, 255, 0.95);
            color: #1f2937;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            pointer-events: none;
            z-index: 100;
        }
    </style>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8 flex items-center gap-3">
                <div class="p-3 bg-blue-600 rounded-lg shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Reportes y Análisis</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div
                    class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Total Tickets</p>
                            <h3 class="text-4xl font-bold text-gray-900">{{ $totalTickets }}</h3>
                        </div>
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-full">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 mb-1">Cerrados (Mes)</p>
                            <h3 class="text-4xl font-bold text-gray-900">{{ $ticketsCerradosMes }}</h3>
                        </div>
                        <div class="p-3 bg-green-50 text-green-600 rounded-full">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Problemas por Tipo</h3>
                    <div class="h-64 relative"><canvas id="tipoChart"></canvas></div>
                </div>
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Por Prioridad</h3>
                    <div class="h-64 relative"><canvas id="prioridadChart"></canvas></div>
                </div>
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Por Estado</h3>
                    <div class="h-64 relative"><canvas id="estadoChart"></canvas></div>
                </div>
                <div class="grid grid-cols-1 mb-8">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Horas Trabajadas por Taller
                        </h3>
                        <div class="h-80 relative w-full"><canvas id="horasTallerChart"></canvas></div>
                    </div>
                </div>
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Ingreso de Solicitudes (30 días)</h3>
                    <div class="h-80 relative w-full"><canvas id="timelineChart"></canvas></div>
                </div>
            </div>




        </div>
    </div>

    <!-- Data (sin hidden para evitar problemas de animación) -->
    <div id="chart-data"
         data-tipo-labels="{{ json_encode($topProblemasLabels) }}"
         data-tipo-values="{{ json_encode($topProblemasData) }}"
         data-prio-keys="{{ json_encode(array_keys($ticketsPorPrioridad)) }}"
         data-prio-values="{{ json_encode(array_values($ticketsPorPrioridad)) }}"
         data-estado-keys="{{ json_encode(array_keys($ticketsPorEstado)) }}"
         data-estado-values="{{ json_encode(array_values($ticketsPorEstado)) }}"
         data-time-labels="{{ json_encode($chartDataFechaLabels) }}"
         data-time-values="{{ json_encode($chartDataFechaValues) }}"
         data-taller-labels="{{ json_encode($tallerLabels) }}"
         data-taller-hours="{{ json_encode($tallerHours) }}"
         style="display:none">
    </div>

    <!-- Chart.js v3 para asegurar animaciones -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dataDiv = document.getElementById('chart-data');

            const dTipo = {l: JSON.parse(dataDiv.dataset.tipoLabels), v: JSON.parse(dataDiv.dataset.tipoValues)};
            const dPrio = {l: JSON.parse(dataDiv.dataset.prioKeys), v: JSON.parse(dataDiv.dataset.prioValues)};
            const dEst = {l: JSON.parse(dataDiv.dataset.estadoKeys), v: JSON.parse(dataDiv.dataset.estadoValues)};
            const dTime = {l: JSON.parse(dataDiv.dataset.timeLabels), v: JSON.parse(dataDiv.dataset.timeValues)};
            const dTaller = {l: JSON.parse(dataDiv.dataset.tallerLabels), v: JSON.parse(dataDiv.dataset.tallerHours)};

            Chart.defaults.font.family = "'Inter', sans-serif";
            Chart.defaults.color = '#4b5563';

            const tooltipSettings = {
                enabled: true,
                backgroundColor: '#ffffff',
                titleColor: '#1f2937',
                bodyColor: '#4b5563',
                borderColor: '#e5e7eb',
                borderWidth: 1,
                padding: 10,
                displayColors: true,
                callbacks: {
                    label: function (context) {
                        return ' Cantidad: ' + context.formattedValue;
                    }
                }
            };

            const baseAnimation = {
                delay: 200,
                duration: 2000,
                easing: 'easeOutBounce'
            };

            // 1. Tipo
            new Chart(document.getElementById('tipoChart'), {
                type: 'bar',
                data: {
                    labels: dTipo.l,
                    datasets: [{
                        data: dTipo.v,
                        backgroundColor: '#3b82f6',
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: baseAnimation,
                    plugins: {legend: {display: false}, tooltip: tooltipSettings},
                    scales: {y: {beginAtZero: true}}
                }
            });

            // 2. Prioridad
            new Chart(document.getElementById('prioridadChart'), {
                type: 'doughnut',
                data: {
                    labels: dPrio.l,
                    datasets: [{
                        data: dPrio.v,
                        backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#ef4444'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%',
                    animation: {
                        animateRotate: true,
                        animateScale: true,
                        duration: 2000,
                        easing: 'easeOutCirc'
                    },
                    plugins: {
                        legend: {display: true, position: 'right'},
                        tooltip: tooltipSettings
                    }
                }
            });

            // 3. Estado
            new Chart(document.getElementById('estadoChart'), {
                type: 'bar',
                data: {
                    labels: dEst.l,
                    datasets: [{
                        data: dEst.v,
                        backgroundColor: ['#94a3b8', '#3b82f6', '#10b981'],
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: baseAnimation,
                    plugins: {legend: {display: false}, tooltip: tooltipSettings},
                    scales: {y: {beginAtZero: true}}
                }
            });

            // 4. Horas Taller
            const tooltipHoras = JSON.parse(JSON.stringify(tooltipSettings));
            tooltipHoras.callbacks = {
                label: function (context) {
                    return ' Horas: ' + context.formattedValue + 'h';
                }
            };

            new Chart(document.getElementById('horasTallerChart'), {
                type: 'bar',
                data: {
                    labels: dTaller.l,
                    datasets: [{
                        data: dTaller.v,
                        backgroundColor: '#6366f1',
                        borderRadius: 6,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: baseAnimation,
                    plugins: {legend: {display: false}, tooltip: tooltipHoras},
                    scales: {y: {beginAtZero: true}}
                }
            });

            // 5. Timeline
            const ctxTimeline = document.getElementById('timelineChart').getContext('2d');
            const gradient = ctxTimeline.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(59, 130, 246, 0.3)');
            gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');

            new Chart(ctxTimeline, {
                type: 'line',
                data: {
                    labels: dTime.l,
                    datasets: [{
                        data: dTime.v,
                        borderColor: '#3b82f6',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#3b82f6',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        delay: 200,
                        duration: 2000,
                        easing: 'easeOutQuart'
                    },
                    plugins: {legend: {display: false}, tooltip: tooltipSettings},
                    interaction: {mode: 'index', intersect: false},
                    scales: {y: {beginAtZero: true}}
                }
            });
        });
    </script>
</x-app-layout>
