    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment"></script>


<div class="bg-body-tertiary mb-5 rounded border border-4 p-3 shadow" style="width: 80%; margin: auto; height: 75%;">
    <h1 style="text-align: center; width: -webkit-fill-available; font-size: 30px">Kw por segundo</h1>
    <div style="display: flex; flex-direction: column; align-items: center;">
        <label for="deviceSelector">Selecciona un dispositivo:</label>
        <select id="deviceSelector" onchange="updateChartData()">
            <option value="xbox">Xbox</option>
            <option value="Computadora">Computadora</option>
            <option value="Refrigerador">Refrigerador</option>
        </select>
    </div>
    <canvas id="deviceUsageChart"></canvas>
</div>



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
            xbox: 0.042
            , Computadora: 0.072
            , Refrigerador: 0.050
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
            type: 'line'
            , data: {
                labels: getTimestampLabels()
                , datasets: [{
                    label: 'Uso de ' + selectedDevice + ' en kW/s'
                    , data: generateDeviceUsageData(selectedDevice)
                    , backgroundColor: 'rgba(54, 162, 235, 0.2)'
                    , borderColor: 'rgba(54, 162, 235, 1)'
                    , borderWidth: 2
                    , pointRadius: 5
                    , pointBackgroundColor: 'rgba(54, 162, 235, 1)'
                    , pointBorderColor: 'rgba(54, 162, 235, 1)'
                    , pointHoverRadius: 7
                    , pointHoverBackgroundColor: 'rgba(54, 162, 235, 1)'
                    , pointHoverBorderColor: 'rgba(54, 162, 235, 1)'
                    , borderDash: [5, 5]
                }]
            }
            , options: {
                scales: {
                    y: {
                        beginAtZero: true
                        , max: 0.088
                        , title: {
                            display: true
                            , text: 'KW'
                        }
                    }
                    , x: {
                        title: {
                            display: true
                            , text: 'Hora'
                        }
                    }
                , }
                , elements: {
                    line: {
                        tension: 0.2
                    }
                }
                , plugins: {
                    legend: {
                        display: true
                        , position: 'top'
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

<div class="bg-body-tertiary mb-5 rounded border border-4 p-3 shadow" style="width: 80%; margin: auto; height: 600px;">
    <h1 style="text-align: center; width: -webkit-fill-available; font-size: 30px">Top 5 dispositivos</h1>
    <canvas id="topConsumersChart"></canvas>
</div>


<script>
        // Function to create additional charts
        function createAdditionalCharts1() {

            // Predetermined data for the fourth additional chart (top 5 consumers)
            const topConsumerLabels = ['Router', 'Computadora', 'TV', 'Refrigerador', 'Lavadora'];
            const topConsumerData = [550, 480, 600, 520, 540];



            // Create the fourth additional chart (top 5 consumers)
            const topCtx = document.getElementById('topConsumersChart').getContext('2d');
            const topConsumersChart = new Chart(topCtx, {
                type: 'bar'
                , data: {
                    labels: topConsumerLabels
                    , datasets: [{
                        label: 'Top 5 Dispositivos'
                        , data: topConsumerData
                        , backgroundColor: 'rgba(75, 192, 192, 0.6)'
                        
                    , }]
                }
                , options: {
                    responsive: true
                    , maintainAspectRatio: false
                    , scales: {
                        x: {
                            type: 'category', // Specify that the X axis is a category axis
                            title: {
                                display: true
                                , text: 'Dia' // Label for the X axis
                            }
                        }
                        , y: {
                            title: {
                                display: true
                                , text: 'KW' // Label for the Y axis
                            }
                        }
                    }
                    , plugins: {}
                }
            });
        }

        // Call the function to create additional charts
        createAdditionalCharts1();

</script>


<div class="row" style="
                                padding-left: 50px;
                                padding-right: 50px;">

    <!-- Existing code as it is -->
    <div class="row" style="display: contents">
        <!-- Add the first additional chart -->
        <div class="col-lg-6 bg-body-tertiary mb-5 rounded border border-4 p-3 shadow">
            <h1 style="text-align: center; width: -webkit-fill-available; font-size: 30px">Consumo
                diario</h1>
            <div style="height: 500px;">
                <canvas id="dailyConsumptionChart"></canvas>
            </div>
        </div>

        <!-- Add the second additional chart -->
        <div class="col-lg-6 bg-body-tertiary mb-5 rounded border border-4 p-3 shadow">
            <h1 style="text-align: center; width: -webkit-fill-available; font-size: 30px">Consumo
                mensual</h1>
            <div style="height: 500px;">
                <canvas id="monthlyConsumptionChart"></canvas>
            </div>
        </div>
    </div>
 
    

    {{-- <style>
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

    </style> --}}

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

    <canvas id="lecturaSensorChartt" style="width: 80%; margin: auto; height: 500px;"></canvas>

    <script>
        var ctxx = document.getElementById('lecturaSensorChartt').getContext('2d');
        var lecturaSensor = @json($dataRead);

        var myChartt = createChart(); // Crear la gráfica inicialmente

        function createChart() {
            return new Chart(ctxx, {
                type: 'bar'
                , data: {
                    labels: []
                    , datasets: [{
                        label: 'Lectura del Sensor (kWh)'
                        , data: []
                        , backgroundColor: 'rgba(75, 192, 192, 0.5)'
                        , borderColor: 'rgba(75, 192, 192, 1)'
                        , borderWidth: 2
                        , hoverBackgroundColor: 'rgba(75, 192, 192, 0.7)'
                        , hoverBorderColor: 'rgba(75, 192, 192, 1)'
                        , fill: false
                    , }]
                }
                , options: {
                    scales: {
                        x: {
                            title: {
                                display: true
                                , text: 'Fecha'
                            }
                            , grid: {
                                display: false
                            }
                        }
                        , y: {
                            beginAtZero: true
                            , title: {
                                display: true
                                , text: 'Consumo de Energía (kWh)'
                            }
                            , grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            , }
                        }
                    }
                    , plugins: {
                        legend: {
                            display: true
                            , position: 'top'
                        }
                    }
                }
            });
        }

        function updateChartt() {
            var selectedNombre = document.getElementById('nombre').value;
            var lecturasFiltradas = lecturaSensor.filter(function(dato) {
                return dato.name_aparato == selectedNombre;
            });

            var date = lecturasFiltradas.map(function(dato) {
                return dato.date.substring(0, 10);
            });

            var valores = lecturasFiltradas.map(function(dato) {
                return dato.total_kw;
            });

            // Actualizar datos de la gráfica existente
            myChartt.data.labels = date;
            myChartt.data.datasets[0].data = valores;

            // Actualizar la gráfica
            myChartt.update();
        }

        // Llamar a la función inicialmente para cargar la gráfica con el primer nombre
        updateChartt();

    </script>

    
    <div class="bg-body-tertiary mb-5 rounded border border-4 p-3 shadow" style="width: 80%; margin: auto; height: 500px;">
        <h1 style="text-align: center; width: -webkit-fill-available; font-size: 30px">Consumo predectivo (1 mes)</h1>
        <canvas id="graficoConsumo"></canvas>
    </div>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            var datosConsumo = @json($datosConsumo);
            var datosConsumo24 = @json($datosConsumo24);

            console.log(datosConsumo)
            // Agrega más datos según tu estructura de base de datos
            var fechas = datosConsumo.map(function(dato) {
                return moment(dato.fecha).format(
                    'MM-DD'); // Puedes cambiar el formato según tus necesidades
            });
            console.log(fechas)
            var cocina = datosConsumo.map(function(dato) {
                return dato.cocina // Puedes cambiar el formato según tus necesidades
            });
            console.log(cocina)

            var sala = datosConsumo24.map(function(dato) {
                return dato.cocina // Puedes cambiar el formato según tus necesidades
            });


            // Agrega más datos según tu estructura de base de datos
            // var fechas24 = datosConsumo24.map(function(dato) {
            //             return moment(dato.fecha).format('YYYY-MM-DD'); // Puedes cambiar el formato según tus necesidades
            // });

            // var cocina24 = datosConsumo24.map(function(dato) {
            //             return dato.cocina // Puedes cambiar el formato según tus necesidades
            // });
            // console.log(cocina24)





            console.log(sala)
            // Configuración del gráfico
            var ctxConsumo = document.getElementById('graficoConsumo').getContext('2d');
            var chartConsumo = new Chart(ctxConsumo, {
                type: 'line'
                , data: {
                    labels: fechas
                    , datasets: [{
                            label: 'Cocina 2023'
                            , data: cocina
                            , borderColor: 'rgba(75, 192, 192, 1)'
                            , backgroundColor: 'rgba(75, 192, 192, 0.2)'
                            , borderWidth: 2
                            , pointRadius: 5
                            , pointBackgroundColor: 'rgba(75, 192, 192, 1)'
                            , pointBorderColor: 'rgba(75, 192, 192, 1)'
                        , }
                        , {
                            label: 'Cocina 2024'
                            , data: sala
                            , borderColor: 'rgba(3, 252, 28, 1)'
                            , borderWidth: 1
                            , fill: false
                            , backgroundColor: 'rgba(3, 252, 28, 1)'
                            , borderWidth: 2
                            , pointRadius: 5
                            , pointBackgroundColor: 'rgba(3, 252, 28, 1)'
                            , pointBorderColor: 'rgba(3, 252, 28, 1)'
                        , },
                        // Agrega más datasets según tu estructura de base de datos
                    ]
                }
                , options: {
                    scales: {
                        x: {
                            title: {
                                display: true
                                , text: 'Fechas' // Label for the X axis
                            }
                        }
                        , y: {
                            beginAtZero: true
                            , title: {
                                display: true
                                , text: 'KW/Dia' // Label for the X axis
                            }
                        }
                    }
                }
            })
        });

    </script> --}}

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

    <form action="{{ route("filtrar-fechas") }}" method="get" class="formFecha">
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio">

        <label for="fecha_fin">Fecha de fin:</label>
        <input type="date" name="fecha_fin" id="fecha_fin">

        <button type="submit">Filtrar</button>
    </form>

    <div class="bg-body-tertiary mb-5 rounded border border-4 p-3 shadow" style="width: 80%; margin: auto; height: 500px;">
        <canvas id="miGrafica" style="width: 100%; height: 100%;"></canvas>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('miGrafica').getContext('2d');
            var datos = @json($datos);
            console.log(datos);


            var valoresPorFecha = {};

            datos.forEach(function(dato) {
                var fecha = dato.date.substring(0, 10);
                var kwh = dato.kw_per_day;

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
                type: 'line'
                , data: {
                    labels: fechas
                    , datasets: [{
                        label: 'Consumo'
                        , data: valores
                        , borderColor: 'rgba(75, 192, 192, 1)'
                        , backgroundColor: 'rgba(75, 192, 192, 0.2)'
                        , borderWidth: 2
                        , pointRadius: 5
                        , pointBackgroundColor: 'rgba(75, 192, 192, 1)'
                        , pointBorderColor: 'rgba(75, 192, 192, 1)'
                    , }]
                }
                , options: {
                    scales: {
                        x: {
                            title: {
                                display: true
                                , text: 'Fecha'
                            }
                        }
                        , y: {
                            title: {
                                display: true
                                , text: 'KW/D'
                            }
                        , }
                    }
                    , legend: {
                        display: true
                        , position: 'top'
                    , }
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
                type: 'bar'
                , data: {
                    labels: dailyLabels
                    , datasets: [{
                        label: 'Consumo diario'
                        , data: dailyData
                        , backgroundColor: 'rgba(54, 162, 235, 0.6)'
                        , borderWidth: 1
                    , }]
                }
                , options: {
                    responsive: true
                    , maintainAspectRatio: false
                    , scales: {
                        x: {
                            type: 'category', // Specify that the X axis is a category axis
                            title: {
                                display: true
                                , text: 'Dia' // Label for the X axis
                            }
                        }
                        , y: {
                            title: {
                                display: true
                                , text: 'KW' // Label for the Y axis
                            }
                        }
                    }
                    , plugins: {}
                }
            });

            // Create the second additional chart (monthly consumption)
            const monthlyCtx = document.getElementById('monthlyConsumptionChart').getContext('2d');
            const monthlyConsumptionChart = new Chart(monthlyCtx, {
                type: 'bar'
                , data: {
                    labels: monthlyLabels
                    , datasets: [{
                        label: 'Consumo mensual'
                        , data: monthlyData
                        , backgroundColor: 'rgba(255, 99, 132, 0.6)'
                        , borderWidth: 1
                    , }]
                }
                , options: {
                    responsive: true
                    , maintainAspectRatio: false
                    , scales: {
                        x: {
                            type: 'category', // Specify that the X axis is a category axis
                            title: {
                                display: true
                                , text: 'Meses' // Label for the X axis
                            }
                        }
                        , y: {
                            title: {
                                display: true
                                , text: 'KW' // Label for the Y axis
                            }
                        }
                    }
                    , plugins: {}
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
                    type: 'line'
                    , data: {
                        labels: meses
                        , datasets: [{
                            label: 'KW por hora'
                            , data: ventas
                            , borderColor: 'rgba(75, 192, 192, 1)'
                            , backgroundColor: 'rgba(75, 192, 192, 0.2)'
                            , borderWidth: 3
                            , fill: true
                        }]
                    }
                    , options: {
                        responsive: true
                        , maintainAspectRatio: false
                        , scales: {
                            x: {
                                type: 'category', // Specify that the X axis is a category axis
                                title: {
                                    display: true
                                    , text: 'Hora' // Label for the X axis
                                }
                            }
                            , y: {
                                title: {
                                    display: true
                                    , text: 'KW' // Label for the Y axis
                                }
                            }
                        }
                        , plugins: {

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
