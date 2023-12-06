@extends('layouts.app')

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment"></script>


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

                                                    @foreach ($bill as $pagar)
                                                        {{ $pagar->Total_Pagar }}
                                                    @endforeach

                                                    $
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <label for="deviceSelector">Selecciona un dispositivo:</label>
                            <select id="deviceSelector" onchange="updateChartData()">
                                <option value="xbox">Xbox</option>
                                <option value="Computadora">Computadora</option>
                                <option value="Refrigerador">Refrigerador</option>
                                <!-- Agrega más opciones según sea necesario -->
                            </select>
                        </div>
                        <div class="border border-4 shadow p-3 mb-5 bg-body-tertiary rounded"
                            style="width: 80%; margin: auto; height: 40%;">
                            <h1 style="text-align: center; width: -webkit-fill-available; font-size: 30px">Kw por segundo
                            </h1>
                            <canvas id="deviceUsageChart"></canvas>


                        </div>

                        <div class="row"
                            style="
                                padding-left: 50px;
                                padding-right: 50px;">

                            <!-- Existing code as it is -->
                            <div class="row" style="display: contents">
                                <!-- Add the first additional chart -->
                                <div class="col-lg-6 border border-4 shadow p-3 mb-5 bg-body-tertiary rounded">
                                    <h1 style="text-align: center; width: -webkit-fill-available; font-size: 30px">Consumo
                                        diario</h1>
                                    <div style="height: 500px;">
                                        <canvas id="dailyConsumptionChart"></canvas>
                                    </div>
                                </div>

                                <!-- Add the second additional chart -->
                                <div class="col-lg-6 border border-4 shadow p-3 mb-5 bg-body-tertiary rounded">
                                    <h1 style="text-align: center; width: -webkit-fill-available; font-size: 30px">Consumo
                                        mensual</h1>
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

                            <div>
                                <hr> <!-- Additional line -->
                                <h1 class="cocina">Consumo de los dispositivos</h1>
                                <label for="nombre">Seleccionar Nombre:</label>
                                <select id="nombre" onchange="updateChartt()">
                                    <?php
                                    $uniqueNames = [];
                                    ?>
                                    @foreach ($dataRead as $data)
                                        <?php
                                    // Verificar si el name_aparato ya se ha agregado al conjunto
                                    if (!in_array($data->name_aparato, $uniqueNames)) {
                                        // Si no, agregarlo al conjunto y mostrar la opción en el select
                                        $uniqueNames[] = $data->name_aparato;
                                    ?>
                                        <option value="{{ $data->name_aparato }}">{{ $data->name_aparato }}</option>
                                        <?php
                                    }
                                    ?>
                                    @endforeach
                                </select>
                            </div>


                            <canvas id="lecturaSensorChartt" width="400" height="200"></canvas>

                            <script>
                                var ctxx = document.getElementById('lecturaSensorChartt').getContext('2d');
                                var lecturaSensor = @json($dataRead);

                                var myChartt; // Declarar la variable fuera de la función

                                // Función para actualizar la gráfica según el nombre seleccionado
                                function updateChartt() {
                                    var selectedNombre = document.getElementById('nombre').value;
                                    var lecturasFiltradas = lecturaSensor.filter(function(dato) {
                                        return dato.name_aparato == selectedNombre;
                                    });

                                    //var ultimosRegistros = lecturasFiltradas.slice(-7);

                                    var date = lecturasFiltradas.map(function(dato) {
                                        return dato.date.substring(0, 10);
                                    });

                                    var valores = lecturasFiltradas.map(function(dato) {
                                        return dato.total_kw;
                                    });

                                    var nameUser = lecturasFiltradas.map(function(dato) {
                                        return dato.name;
                                    });

                                    // Limpiar la gráfica anterior
                                    if (myChartt) {
                                        myChartt.destroy();
                                    }

                                    // Crear una nueva gráfica con datos actualizados
                                    myChartt = new Chart(ctxx, {
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
                                updateChartt();
                            </script>



                            <hr> <!-- Additional line -->
                            <h1 class="cocina">Consumo de los dispositivos</h1>

                            <div class="border border-4 shadow p-3 mb-5 bg-body-tertiary rounded"
                                style=" width: 80%; margin: auto;height: 500px;">
                                <table>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fecha y Hora</th>
                                        <th>Cocina</th>
                                        <!-- Agrega otras columnas según sea necesario -->
                                    </tr>
                                    @foreach ($consumptionData as $data)
                                        <tr>
                                            <td>{{ $data->ID }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->DATE_TIME)->toDateString() }}</td>
                                            <td>{{ $data->Cocina }}</td>
                                            <!-- Agrega otras columnas según sea necesario -->
                                        </tr>
                                    @endforeach
                                </table>
                            </div>




                            <h1 style="margin-left: 3%;">Consumo entre fechas</h1>

                            <style>
                                .formFecha {
                                    display: flex;
                                    flex-direction: row;
                                    align-items: center;
                                    margin-left: 2%;
                                }

                                .form-group {
                                    margin-bottom: 10px;
                                }

                                label {
                                    margin-left: 2%;
                                    font-size: large;
                                }

                                input[type="date"],
                                button {
                                    padding: 5px;
                                    font-size: 16px;
                                }

                                button {
                                    background-color: #007bff;
                                    color: white;
                                    border: none;
                                    cursor: pointer;
                                }

                                button:hover {
                                    background-color: #0056b3;
                                }
                            </style>

                            <form action="{{ route('filtrar-fechas') }}" method="get" class="formFecha">
                                <label for="fecha_inicio">Fecha de inicio:</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio">

                                <label for="fecha_fin">Fecha de fin:</label>
                                <input type="date" name="fecha_fin" id="fecha_fin">

                                <button type="submit">Filtrar</button>
                            </form>


                            <div class="border border-4 shadow p-3 mb-5 bg-body-tertiary rounded"
                                style="width: 80%; margin: auto; height: 500px;">
                                <canvas id="miGrafica" style="width: 100%; height: 100%;"></canvas>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var ctx = document.getElementById('miGrafica').getContext('2d');
                                    var datos = @json($datos);

                                    var valoresPorFecha = {};

                                    datos.forEach(function(dato) {
                                        var fecha = dato.date;
                                        var kwh = dato.kwh;

                                        // Si la fecha ya existe en el objeto, suma el valor de KWH
                                        if (valoresPorFecha[fecha]) {
                                            valoresPorFecha[fecha] += kwh;
                                        } else {
                                            valoresPorFecha[fecha] = kwh;
                                        }
                                    });

                                    // Obtener las fechas y los valores de KWH del objeto actualizado
                                    var fechas = Object.keys(valoresPorFecha);
                                    var valores = Object.values(valoresPorFecha);

                                    var myChart = new Chart(ctx, {
                                        type: 'line',
                                        data: {
                                            labels: fechas,
                                            datasets: [{
                                                label: 'Consumo',
                                                data: valores,
                                                borderColor: 'rgba(75, 192, 192, 1)',
                                                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Agrega un color de fondo para el área bajo la línea
                                                borderWidth: 2,
                                                pointRadius: 5, // Aumenta el tamaño de los puntos de datos
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
                                                        maxRotation: 0, // Rota las etiquetas del eje x para una mejor legibilidad
                                                        autoSkip: true,
                                                        maxTicksLimit: 10 // Limita el número de marcas del eje x para un mejor espaciado
                                                    }
                                                }],
                                                y: [{
                                                    ticks: {
                                                        beginAtZero: true,
                                                        callback: function(value) {
                                                            return value
                                                                .toLocaleString(); // Agrega comas para un mejor formato de etiqueta del eje y
                                                        }
                                                    }
                                                }]
                                            },
                                            legend: {
                                                display: true,
                                                position: 'top', // Posiciona la leyenda en la parte superior para una mejor visibilidad
                                            }
                                        }
                                    });
                                });
                            </script>




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
                        <script>
                            var ctx = document.getElementById('deviceUsageChart').getContext('2d');
                            var deviceChart;
                            let intervalId;

                            // Función para generar datos de uso de dispositivos en segundos
                            function generateDeviceUsageData(device) {
                                var deviceData = [];
                                for (var i = 0; i < 5; i++) {
                                    deviceData.push((Math.random() * getMaxUsage(device)).toFixed(5));
                                }
                                return deviceData;
                            }

                            function getMaxUsage(device) {
                                var maxUsage = {
                                    xbox: 0.042,
                                    Computadora: 0.072,
                                    Refrigerador: 0.050
                                };
                                return maxUsage[device];
                            }

                            function updateChartData() {
                                var selectedDevice = document.getElementById('deviceSelector').value;

                                if (deviceChart) {
                                    deviceChart.destroy();
                                    clearInterval(intervalId);
                                }

                                deviceChart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: getTimestampLabels(),
                                        datasets: [{
                                            label: 'Uso de ' + selectedDevice + ' en kW/s',
                                            data: generateDeviceUsageData(selectedDevice),
                                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                            borderColor: 'rgba(54, 162, 235, 1)',
                                            borderWidth: 2,
                                            pointRadius: 5,
                                            pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                                            pointBorderColor: 'rgba(54, 162, 235, 1)',
                                            pointHoverRadius: 7,
                                            pointHoverBackgroundColor: 'rgba(54, 162, 235, 1)',
                                            pointHoverBorderColor: 'rgba(54, 162, 235, 1)',
                                            borderDash: [5, 5]
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                max: 0.088,
                                                title: {
                                                    display: true,
                                                    text: 'KW'
                                                }
                                            },
                                            x: {
                                                title: {
                                                    display: true,
                                                    text: 'Hora'
                                                }
                                            },
                                        },
                                        elements: {
                                            line: {
                                                tension: 0.2
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                display: true,
                                                position: 'top'
                                            }
                                        }
                                    }
                                });

                                intervalId = setInterval(function() {
                                    var newData = generateDeviceUsageData(selectedDevice);
                                    deviceChart.data.datasets[0].data.shift();
                                    deviceChart.data.datasets[0].data.push(newData[4]);
                                    deviceChart.data.labels = getTimestampLabels();
                                    deviceChart.update();
                                }, 1000);
                            }

                            function getTimestampLabels() {
                                var labels = [];
                                var currentTime = new Date();
                                for (var i = 0; i < 5; i++) {
                                    var timestamp = new Date(currentTime.getTime() + i * 3000);
                                    var hours = timestamp.getHours();
                                    var minutes = timestamp.getMinutes();
                                    var seconds = timestamp.getSeconds();
                                    labels.push(`${hours}:${minutes}:${seconds}`);
                                }
                                return labels;
                            }

                            updateChartData();
                        </script>

                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection
