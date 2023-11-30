@extends('layouts.app')

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

</head>
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Dashboard</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card kpi">
                                            <div class="card-body">
                                                <h5 class="card-title"><i class="fas fa-chart-line fa-2x"></i> Top
                                                    dispositivo</h5>
                                                <p class="card-text value">TV</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card kpi">
                                            <div class="card-body">
                                                <h5 class="card-title"><i class="fas fa-coffee fa-lg"></i> Consumo promedio
                                                    diario</h5>
                                                <p class="card-text value">8 Kw</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card kpi">
                                            <div class="card-body">
                                                <h5 class="card-title"><i class="fas fa-dollar-sign fa-lg"></i> Gasto actual
                                                </h5>
                                                <p class="card-text value">
                                                    <script></script> $
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row"
                                style="
                                padding-left: 50px;
                                padding-right: 50px;">

                                <!-- Existing code as it is -->
                                <div class="row" style="display: contents">
                                    <!-- Add the first additional chart -->
                                    <div class="col-lg-6 border border-4 shadow p-3 mb-5 bg-body-tertiary rounded">
                                        <h1 style="text-align: center; width: -webkit-fill-available; font-size: 30px">
                                            Consumo diario</h1>
                                        <div style="height: 500px;">
                                            <canvas id="dailyConsumptionChart"></canvas>
                                        </div>
                                    </div>

                                    <!-- Add the second additional chart -->
                                    <div class="col-lg-6 border border-4 shadow p-3 mb-5 bg-body-tertiary rounded">
                                        <h1 style="text-align: center; width: -webkit-fill-available; font-size: 30px">
                                            Consumo mensual</h1>
                                        <div style="height: 500px;">
                                            <canvas id="monthlyConsumptionChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <!-- Existing code as it is -->



                                <!-- Fourth additional chart: Top 5 Consumers -->
                                <h1 style="text-align: center; width: -webkit-fill-available; font-size: 30px">Top 5
                                    dispositivos</h1>
                                <div class="border border-4 shadow p-3 mb-5 bg-body-tertiary rounded"
                                    style="width: 80%; margin: auto; height: 500px;">

                                    <canvas id="topConsumersChart"></canvas>


                                </div>
                            </div>
                            <div>
                                <hr> <!-- Línea adicional -->
                                <h1 class="cocina">Cocina (Ultimos 7 dias)</h1>
                                <label for="nombre">Seleccionar Nombre:</label>
                                <select id="nombre" onchange="updateChart()">
                                    @foreach ($nombres as $nombre)
                                        <option value="{{ $nombre }}">{{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <canvas id="lecturaSensorChart" width="400" height="200"></canvas>

                            <script>
                                var ctx = document.getElementById('lecturaSensorChart').getContext('2d');
                                var lecturaSensor = @json($lecturaSensor);

                                var myChart; // Declarar la variable fuera de la función

                                // Función para actualizar la gráfica según el nombre seleccionado
                                function updateChart() {
                                    var selectedNombre = document.getElementById('nombre').value;
                                    var lecturasFiltradas = lecturaSensor.filter(function(dato) {
                                        return dato.name_aparato === selectedNombre;
                                    });

                                    var ultimosRegistros = lecturasFiltradas.slice(-7);

                                    var date = ultimosRegistros.map(function(dato) {
                                        return dato.date.substring(0, 10);
                                    });

                                    var valores = ultimosRegistros.map(function(dato) {
                                        return dato.kw_per_day;
                                    });
                                    // Limpiar la gráfica anterior
                                    if (myChart) {
                                        myChart.destroy();
                                    }

                                    // Crear una nueva gráfica con datos actualizados
                                    myChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: date,
                                            datasets: [{
                                                label: 'Lectura del Sensor (kWh)',
                                                data: valores,
                                                backgroundColor: 'rgba(75, 192, 192, 0.5)', // Color de fondo
                                                borderColor: 'rgba(75, 192, 192, 1)',
                                                borderWidth: 2,
                                                hoverBackgroundColor: 'rgba(75, 192, 192, 0.7)', // Color de fondo al pasar el ratón
                                                hoverBorderColor: 'rgba(75, 192, 192, 1)',
                                                fill: false,
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                x: {
                                                    title: {
                                                        display: true,
                                                        text: 'Fecha' // Título del eje y
                                                    },
                                                    grid: {
                                                        display: false // Ocultar líneas de la cuadrícula en el eje x
                                                    }
                                                },
                                                y: {
                                                    beginAtZero: true,
                                                    title: {
                                                        display: true,
                                                        text: 'Consumo de Energía (kWh)' // Título del eje y
                                                    },
                                                    grid: {
                                                        color: 'rgba(0, 0, 0, 0.1)', // Color de las líneas de la cuadrícula en el eje y
                                                    }
                                                }
                                            },
                                            plugins: {
                                                legend: {
                                                    display: true,
                                                    position: 'top' // Posición de la leyenda
                                                }
                                            }
                                        }
                                    });

                                }

                                // Llamar a la función inicialmente para cargar la gráfica con el primer nombre
                                updateChart();
                            </script>
                            <h1>Datos de consumo</h1>
                            <style>
                                .card-title i {
                                    font-size: 24px;
                                    /* Ajusta el tamaño según tus preferencias */
                                    margin-right: 8px;
                                    /* Agrega un espacio entre el icono y el texto si es necesario */
                                }

                                .card-text {
                                    font-size: 24px;
                                }

                                table {
                                    width: 100%;
                                    border-collapse: collapse;
                                    margin-top: 20px;
                                }

                                th,
                                td {
                                    border: 1px solid #dddddd;
                                    text-align: left;
                                    padding: 8px;
                                }

                                th {
                                    background-color: #f2f2f2;
                                }

                                tr:hover {
                                    background-color: #f5f5f5;
                                }
                            </style>







                            <!-- Existing code as it is -->

                            <script>
                                // Function to create additional charts
                                function createAdditionalCharts() {
                                    // Predetermined data for the first additional chart (daily consumption)
                                    const dailyLabels = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
                                    const dailyData = [300, 240, 268, 320, 200, 410, 380];

                                    // Predetermined data for the second additional chart (monthly consumption)
                                    const monthlyLabels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio'];
                                    const monthlyData = [800, 850, 820, 900, 920, 950, 980];

                                    // Create the first additional chart (daily consumption)
                                    const dailyCtx = document.getElementById('dailyConsumptionChart').getContext('2d');
                                    const dailyConsumptionChart = new Chart(dailyCtx, {
                                        type: 'bar',
                                        data: {
                                            labels: dailyLabels,
                                            datasets: [{
                                                label: 'Consumo diario',
                                                data: dailyData,
                                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                                borderWidth: 1,
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            scales: {
                                                x: {
                                                    type: 'category', // Specify that the X axis is a category axis
                                                    title: {
                                                        display: true,
                                                        text: 'Dia' // Label for the X axis
                                                    }
                                                },
                                                y: {
                                                    title: {
                                                        display: true,
                                                        text: 'KW' // Label for the Y axis
                                                    }
                                                }
                                            },
                                            plugins: {}
                                        }
                                    });

                                    // Create the second additional chart (monthly consumption)
                                    const monthlyCtx = document.getElementById('monthlyConsumptionChart').getContext('2d');
                                    const monthlyConsumptionChart = new Chart(monthlyCtx, {
                                        type: 'bar',
                                        data: {
                                            labels: monthlyLabels,
                                            datasets: [{
                                                label: 'Consumo mensual',
                                                data: monthlyData,
                                                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                                                borderWidth: 1,
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            scales: {
                                                x: {
                                                    type: 'category', // Specify that the X axis is a category axis
                                                    title: {
                                                        display: true,
                                                        text: 'Meses' // Label for the X axis
                                                    }
                                                },
                                                y: {
                                                    title: {
                                                        display: true,
                                                        text: 'KW' // Label for the Y axis
                                                    }
                                                }
                                            },
                                            plugins: {}
                                        }
                                    });
                                }

                                // Call the function to create additional charts
                                createAdditionalCharts();
                            </script>

                            <script>
                                // Function to create additional charts
                                function createAdditionalCharts() {

                                    // Predetermined data for the fourth additional chart (top 5 consumers)
                                    const topConsumerLabels = ['Router', 'Computadora', 'TV', 'Refrigerador', 'Lavadora'];
                                    const topConsumerData = [550, 480, 600, 520, 540];



                                    // Create the fourth additional chart (top 5 consumers)
                                    const topCtx = document.getElementById('topConsumersChart').getContext('2d');
                                    const topConsumersChart = new Chart(topCtx, {
                                        type: 'bar',
                                        data: {
                                            labels: topConsumerLabels,
                                            datasets: [{
                                                label: 'Top 5 Dispositivos',
                                                data: topConsumerData,
                                                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                                borderWidth: 1,
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            scales: {
                                                x: {
                                                    type: 'category', // Specify that the X axis is a category axis
                                                    title: {
                                                        display: true,
                                                        text: 'Dispositivo' // Label for the X axis
                                                    }
                                                },
                                                y: {
                                                    title: {
                                                        display: true,
                                                        text: 'KW/mes' // Label for the Y axis
                                                    }
                                                }
                                            },
                                            plugins: {}
                                        }
                                    });
                                }

                                // Call the function to create additional charts
                                createAdditionalCharts();
                            </script>

                            <!-- Existing code as it is -->


                        </div>
                        <script>
                            // Función para obtener los datos del controlador
                            function obtenerDatos() {
                                fetch('/chart') // Ruta que apunta al método 'getData' del controlador
                                    .then(response => response.json())
                                    .then(data => {
                                        // Una vez obtenidos los datos, creamos la gráfica
                                        const meses = data.map(item => item.horas + " PM");
                                        const ventas = data.map(item => item.kw);

                                        const maxValue = data.map(item => item.kw);

                                        const ctx = document.getElementById('lineChart').getContext('2d');
                                        const lineChart = new Chart(ctx, {
                                            type: 'line',
                                            data: {
                                                labels: meses,
                                                datasets: [{
                                                    label: 'KW por hora',
                                                    data: ventas,
                                                    borderColor: 'rgba(75, 192, 192, 1)',
                                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                    borderWidth: 3,
                                                    fill: true
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                                maintainAspectRatio: false,
                                                scales: {
                                                    x: {
                                                        type: 'category', // Specify that the X axis is a category axis
                                                        title: {
                                                            display: true,
                                                            text: 'Hora' // Label for the X axis
                                                        }
                                                    },
                                                    y: {
                                                        title: {
                                                            display: true,
                                                            text: 'KW' // Label for the Y axis
                                                        }
                                                    }
                                                },
                                                plugins: {

                                                }
                                            }
                                        });


                                    })
                                    .catch(error => {
                                        console.error('Error al obtener los datos:', error);
                                    });
                            }


                            // Llamamos a la función para obtener los datos y crear la gráfica
                            obtenerDatos();
                        </script>



                        <h1>Consumo entre fechas</h1>


                        <!-- Agrega esto a tu vista -->
                        <form action="{{ route('filtrar-fechas') }}" method="get">
                            <label for="fecha_inicio">Fecha de inicio:</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio">

                            <label for="fecha_fin">Fecha de fin:</label>
                            <input type="date" name="fecha_fin" id="fecha_fin">

                            <button type="submit">Filtrar</button>
                        </form>


                        <canvas id="miGrafica"></canvas>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var ctx = document.getElementById('miGrafica').getContext('2d');
                                                var datos = @json($datos);
                                                // Convertir las fechas a formatos adecuados
                                                var fechas = datos.map(function(dato) {
                                                    return moment(dato.timestamp).format('YYYY-MM-DD'); // Puedes cambiar el formato según tus necesidades
                                                });
                                                // Determinar automáticamente la unidad de agrupación (semana o mes)
                                                var agrupadoPor = determinarUnidadAgrupacion(fechas);
                                                var agrupadoDatos = agruparDatos(datos, agrupadoPor);
                                                var myChart = new Chart(ctx, {
                                                    type: 'line',
                                                    data: {
                                                        labels: agrupadoDatos.labels,
                                                        datasets: [{
                                                            label: 'Consumo',
                                                            data: agrupadoDatos.valores,
                                                            borderColor: 'rgba(75, 192, 192, 1)',
                                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                            borderWidth: 2,
                                                            pointRadius: 5,
                                                            pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                                                            pointBorderColor: 'rgba(75, 192, 192, 1)',
                                                        }]
                                                    },
                                                    options: {
                                                        scales: {
                                                            x: [{
                                                                type: 'time',
                                                                time: {
                                                                    unit: agrupadoPor
                                                                },
                                                                ticks: {
                                                                    maxRotation: 0,
                                                                    autoSkip: true,
                                                                    maxTicksLimit: 10
                                                                }
                                                            }],
                                                            y: [{
                                                                ticks: {
                                                                    beginAtZero: true,
                                                                    callback: function(value) {
                                                                        return value.toLocaleString();
                                                                    }
                                                                }
                                                            }]
                                                        },
                                                        legend: {
                                                            display: true,
                                                            position: 'top',
                                                        }
                                                    }
                                                });
                                                // Función para determinar automáticamente la unidad de agrupación
                                                function determinarUnidadAgrupacion(fechas) {
                                                    // Calcula la diferencia en días entre la primera y la última fecha
                                                    var diffDias = moment(fechas[fechas.length - 1]).diff(moment(fechas[0]), 'days');
                                                    // Decide la unidad de agrupación en base a la diferencia de días
                                                    return diffDias > 30 ? 'month' : 'week';
                                                }
                                                // Función para agrupar datos por semanas o meses
                                                function agruparDatos(datos, unidad) {
                                                    var agrupado = {};
                                                    for (var i = 0; i < datos.length; i++) {
                                                        var fecha = moment(datos[i].timestamp).startOf(unidad).format('YYYY-MM-DD');
                                                        if (!agrupado[fecha]) {
                                                            agrupado[fecha] = {
                                                                total: 0,
                                                                count: 0
                                                            };
                                                        }
                                                        agrupado[fecha].total += datos[i].kw_per_day;
                                                        agrupado[fecha].count += 1;
                                                    }
                                                    var labels = Object.keys(agrupado);
                                                    var valores = labels.map(function(label) {
                                                        return agrupado[label].total / agrupado[label].count;
                                                    });
                                                    return {
                                                        labels: labels,
                                                        valores: valores
                                                    };
                                                }
                                            });
                                        </script>




                        {{-- <label for="interval">Seleccionar Intervalo:</label>
                        <select id="interval" onchange="updateChart()">
                            <option value="daily">Diario</option>
                            <option value="weekly">Semanal</option>
                            <option value="monthly">Mensual</option>
                            <option value="yearly">Anual</option>
                        </select>

                        <canvas id="myChart" width="400" height="400"></canvas>

                        <script>
                            var sensorReadings = @json($sensorReadings);

                            var labels = [];
                            var data = [];

                            sensorReadings.forEach(function(reading) {
                                labels.push(reading.name_aparato);
                                data.push(reading.avg_kw_per_day);
                            });

                            var ctx = document.getElementById('myChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Consumo de energía promedio (kw_per_day)',
                                        data: data,
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });

                            function updateChart() {
                                var interval = document.getElementById('interval').value;
                                window.location.href = '/home/' + interval;
                            }
                        </script> --}}




                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
