<x-app-layout>
    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8 flex items-center gap-3">
                <div class="p-2 bg-indigo-600 rounded-lg shadow-lg shadow-indigo-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                </div>
                <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Reportes y Análisis</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl p-6 text-white shadow-xl relative overflow-hidden group">
                    <div class="relative z-10">
                        <p class="text-blue-100 font-medium text-sm uppercase tracking-wider mb-1">Total de Tickets Recibidos</p>
                        <p class="text-5xl font-extrabold tracking-tight">{{ $totalTickets }}</p>
                    </div>
                    <div class="absolute bottom-4 right-4 text-blue-300">
                        <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-indigo-600 to-purple-800 rounded-2xl p-6 text-white shadow-xl relative overflow-hidden group">
                    <div class="relative z-10">
                        <p class="text-indigo-100 font-medium text-sm uppercase tracking-wider mb-1">Total Cerrados (Mes Actual)</p>
                        <p class="text-5xl font-extrabold tracking-tight">{{ $ticketsCerradosMes }}</p>
                    </div>
                    <div class="absolute bottom-4 right-4 text-indigo-300">
                        <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        Problemas por Tipo
                    </h3>
                    <div class="h-64 relative">
                        <canvas id="tipoChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-orange-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Distribución por Prioridad
                    </h3>
                    <div class="h-64 relative">
                        <canvas id="prioridadChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Estado de Tickets
                    </h3>
                    <div class="h-64 relative">
                        <canvas id="estadoChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 mb-8">
                <h3 class="font-bold text-gray-800 text-lg mb-6 flex items-center">
                    <div class="p-2 bg-purple-100 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    Ingreso de Solicitudes (Últimos 30 días)
                </h3>
                <div class="h-80 relative w-full">
                    <canvas id="timelineChart"></canvas>
                </div>
            </div>

        </div>
    </div>

    <div id="chart-data" 
         data-tipo-labels="{{ json_encode($topProblemasLabels) }}"
         data-tipo-values="{{ json_encode($topProblemasData) }}"
         data-prio-keys="{{ json_encode(array_keys($ticketsPorPrioridad)) }}"
         data-prio-values="{{ json_encode(array_values($ticketsPorPrioridad)) }}"
         data-estado-keys="{{ json_encode(array_keys($ticketsPorEstado)) }}"
         data-estado-values="{{ json_encode(array_values($ticketsPorEstado)) }}"
         data-time-labels="{{ json_encode($chartDataFechaLabels) }}"
         data-time-values="{{ json_encode($chartDataFechaValues) }}"
         class="hidden">
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // Leemos los datos desde el HTML (Sin PHP aquí adentro)
            const dataDiv = document.getElementById('chart-data');
            
            const dataTipo = {
                labels: JSON.parse(dataDiv.dataset.tipoLabels),
                values: JSON.parse(dataDiv.dataset.tipoValues)
            };
            const dataPrioridad = {
                labels: JSON.parse(dataDiv.dataset.prioKeys),
                values: JSON.parse(dataDiv.dataset.prioValues)
            };
            const dataEstado = {
                labels: JSON.parse(dataDiv.dataset.estadoKeys),
                values: JSON.parse(dataDiv.dataset.estadoValues)
            };
            const dataTimeline = {
                labels: JSON.parse(dataDiv.dataset.timeLabels),
                values: JSON.parse(dataDiv.dataset.timeValues)
            };

            // Configuración Global
            Chart.defaults.font.family = "'Inter', sans-serif";
            Chart.defaults.color = '#64748b';

            // GRÁFICO TIPO
            new Chart(document.getElementById('tipoChart'), {
                type: 'bar',
                data: {
                    labels: dataTipo.labels,
                    datasets: [{
                        label: 'Cantidad',
                        data: dataTipo.values,
                        backgroundColor: '#6366f1',
                        borderRadius: 4,
                        barThickness: 25
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, grid: { borderDash: [2, 2] } }, x: { grid: { display: false } } }
                }
            });

            // GRÁFICO PRIORIDAD
            new Chart(document.getElementById('prioridadChart'), {
                type: 'doughnut',
                data: {
                    labels: dataPrioridad.labels,
                    datasets: [{
                        data: dataPrioridad.values,
                        backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#ef4444'],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '60%',
                    plugins: { legend: { position: 'right', labels: { boxWidth: 12, usePointStyle: true } } }
                }
            });

            // GRÁFICO ESTADO
            new Chart(document.getElementById('estadoChart'), {
                type: 'bar',
                data: {
                    labels: dataEstado.labels,
                    datasets: [{
                        label: 'Tickets',
                        data: dataEstado.values,
                        backgroundColor: ['#94a3b8', '#3b82f6', '#475569'],
                        borderRadius: 4,
                        barThickness: 30
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true }, x: { grid: { display: false } } }
                }
            });

            // LÍNEA DE TIEMPO
            const ctxTimeline = document.getElementById('timelineChart').getContext('2d');
            const gradient = ctxTimeline.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(124, 58, 237, 0.4)');
            gradient.addColorStop(1, 'rgba(124, 58, 237, 0)');

            new Chart(ctxTimeline, {
                type: 'line',
                data: {
                    labels: dataTimeline.labels,
                    datasets: [{
                        label: 'Tickets',
                        data: dataTimeline.values,
                        borderColor: '#7c3aed',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#7c3aed',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, grid: { borderDash: [4, 4] } }, x: { grid: { display: false } } },
                    interaction: { intersect: false, mode: 'index' }
                }
            });
        });
    </script>
</x-app-layout>