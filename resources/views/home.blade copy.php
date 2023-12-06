@extends('layouts.app')

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon@3.4.4/build/global/luxon.min.js"></script>

</head>
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Dashboard</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">jj
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

                            {{-- <div class="row"
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
                            </div> --}}


                            {{-- //Dispositivo de la table --}}
                            {{-- <div>
                                <hr> <!-- Línea adicional -->
                                <h1 class="cocina">Dispositivo (Ultimos 7 dias)</h1>
                                <label for="nombre">Seleccionar Nombre:</label>
                                <select id="nombre" onchange="updateChart()">
                                    @foreach ($name_aparato as $name_aparato)
                                        <option value="{{ $name_aparato }}">{{ $name_aparato }}</option>
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
                            </script> --}}
                            {{-- ///end --}}



                            {{-- ///fechas --}}

                            {{-- <h1>Consumo entre fechas</h1>
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
                                console.log(datos);

                                var fechas = datos.map(function(dato) {
                                    return dato.date;
                                });

                                var valores = datos.map(function(dato) {
                                    return dato.kw_per_day;
                                });

                                var myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: fechas,
                                        datasets: [{
                                            label: 'Consumo',
                                            data: valores,
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Add a background color for the area under the line
                                            borderWidth: 2,
                                            pointRadius: 5, // Increase the size of data points
                                            pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                                            pointBorderColor: 'rgba(75, 192, 192, 1)',
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            x: [{
                                                type: 'time',
                                                time: {
                                                    unit: 'day'
                                                },
                                                ticks: {
                                                    maxRotation: 0, // Rotate x-axis labels for better readability
                                                    autoSkip: true,
                                                    maxTicksLimit: 10 // Limit the number of x-axis ticks for better spacing
                                                }
                                            }],
                                            y: [{
                                                ticks: {
                                                    beginAtZero: true,
                                                    callback: function(value) {
                                                        return value
                                                    .toLocaleString(); // Add commas for better y-axis label formatting
                                                    }
                                                }
                                            }]
                                        },
                                        legend: {
                                            display: true,
                                            position: 'top', // Position the legend at the top for better visibility
                                        }
                                    }
                                });
                            });
                        </script> --}}

                            {{-- ///end --}}






                            {{-- <h1>Consumo de los dispositivos</h1>
                        <div style="width: 80%; margin: auto;">
                            <canvas id="myChart"></canvas>
                        </div> --}}

                            {{-- ///Consumo del dispositivo --}}
                            <h1>Consumo total de cada dispositivo</h1>
                            <div style="width: 80%; margin: auto;">
                                <canvas id="myChart"></canvas>
                            </div>

                            <script>
                                // Extrae los datos del controlador
                                var data = @json($data);

                                // Prepara los datos para Chart.js
                                var labels = [];
                                var datasetsData = {};

                                //console.log(data)

                                data.forEach(function(item) {
                                    labels.push(item.name_aparato);

                                    if (!datasetsData[item.usuario]) {
                                        datasetsData[item.usuario] = [];
                                    }


                                    datasetsData[item.usuario].push(item.total_kw);
                                });
                                console.log(datasetsData)

                                // Crea un gráfico por usuario
                                Object.keys(datasetsData).forEach(function(usuario) {
                                    var ctx = document.getElementById('myChart').getContext('2d');

                                    new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: labels,
                                            datasets: [{
                                                // label: 'Usuario ' + name,
                                                data: datasetsData[usuario],
                                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                borderColor: 'rgba(75, 192, 192, 1)',
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true,
                                                    title: {
                                                        display: true,
                                                        text: 'kws'
                                                    }
                                                }

                                            }
                                        }
                                    });
                                });
                            </script>
                            {{-- ///end --}}


                            {{-- <div>
                                <h1>Consumo de los dispositivos por fechas</h1>

                                <label for="intervalo">Seleccionar Intervalo:</label>
                                <select id="intervalo" onchange="updateChart()">
                                    <option value="daily">Diario</option>
                                    <option value="weekly">Semanal</option>
                                    <option value="monthly">Mensual</option>
                                    <option value="yearly">Anual</option>
                                </select>

                                <div style="width: 80%; margin: auto;">
                                    <canvas id="myChart2"></canvas>
                                </div>
                            </div>

                            <script>
                                // Extrae los datos del controlador
                                var data = @json($data);

                                // Inicializa la variable intervalo
                                var intervalo = 'daily';

                                // Lógica para actualizar la variable intervalo
                                function updateChart() {
                                    intervalo = document.getElementById('intervalo').value;

                                    // Llama a la función para actualizar la gráfica
                                    updateChartWithData();
                                }

                                // Función para preparar los datos y crear la gráfica
                                function updateChartWithData() {
                                    // Prepara los datos para Chart.js
                                    var labels = [];
                                    var datasetsData = {};

                                    data.forEach(function(item) {
                                        // Agrega la etiqueta correcta según el intervalo seleccionado
                                        var label = getItemLabel(item, intervalo);
                                        labels.push(label);

                                        if (!datasetsData[item.usuario]) {
                                            datasetsData[item.usuario] = [];
                                        }

                                        datasetsData[item.usuario].push(item.total_kw);
                                    });

                                    // Elimina la gráfica existente antes de crear una nueva
                                    var ctx = document.getElementById('myChart2').getContext('2d');
                                    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);

                                    // Crea un gráfico por usuario
                                    Object.keys(datasetsData).forEach(function(usuario) {
                                        new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: labels,
                                                datasets: [{
                                                    label: 'Usuario ' + usuario,
                                                    data: datasetsData[usuario],
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
                                    });
                                }

                                // Función para obtener la etiqueta correcta según el intervalo seleccionado
                                function getItemLabel(item, intervalo) {
                                    var date = new Date(item.date);
                                    switch (intervalo) {
                                        case 'daily':
                                            return formatDate(date, 'D'); // Día de la semana (por ejemplo, "Mon")
                                        case 'weekly':
                                            return formatDate(date, 'D'); // Día de la semana (por ejemplo, "Mon")
                                        case 'monthly':
                                            return formatDate(date, 'MMMM'); // Nombre del mes (por ejemplo, "January")
                                        case 'yearly':
                                            return formatDate(date, 'YYYY'); // Año
                                        default:
                                            return '';
                                    }
                                }

                                // Función para formatear la fecha con la biblioteca Luxon
                                function formatDate(date, format) {
                                    return luxon.DateTime.fromJSDate(date).toFormat(format);
                                }

                                // Llama a la función para inicializar la gráfica con el intervalo predeterminado
                                updateChartWithData();
                            </script> --}}






                            {{-- <script>
                                var intervalo = 'daily'; // Intervalo predeterminado

                                function updateChart() {
                                    // Actualiza el intervalo según la opción seleccionada
                                    intervalo = document.getElementById('intervalo').value;

                                    // Realiza una llamada AJAX al servidor para obtener los datos actualizados
                                    axios.post('/intervaloTemporal', {
                                            intervalo: intervalo
                                        })
                                        .then(function(response) {
                                            // Actualiza la gráfica con los nuevos datos
                                            updateChartWithData(response.data);
                                        })
                                        .catch(function(error) {
                                            console.error('Error al obtener los datos: ' + error);
                                        });
                                    // Llama a la función para actualizar la gráfica
                                    updateChartWithData();
                                }

                                function updateChartWithData() {
                                    // Tu lógica para obtener datos según el intervalo seleccionado
                                    // Puedes utilizar AJAX para obtener datos del servidor o calcularlos en el cliente
                                    // Actualiza el objeto data según los datos obtenidos

                                    // Limpia el gráfico existente antes de crear uno nuevo
                                    var ctx = document.getElementById('myChart2').getContext('2d');
                                    ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);

                                    // Crea un nuevo gráfico con los datos actualizados
                                    Object.keys(datasetsData).forEach(function(usuario) {
                                        new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: labels,
                                                datasets: [{
                                                    label: 'Usuario ' + usuario,
                                                    data: datasetsData[usuario],
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
                                    });
                                }

                                // Llama a la función para inicializar la gráfica con el intervalo predeterminado
                                updateChartWithData();
                            </script> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
