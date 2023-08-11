@extends('layouts.app')
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                                <div class="row" style="
                                padding-left: 50px;
                                padding-right: 50px;
                            ">
                                    <h1 style="text-align: center; width: -webkit-fill-available; font-size: 30px">Consumo por hora</h1>
                                    <div class="border border-4 shadow p-3 mb-5 bg-body-tertiary rounded" style="width: 80%; margin: auto; height: 500px;">
                                     
                                        <canvas id="lineChart"></canvas>

                                      
                                    </div>
                                    <!-- Existing code as it is -->
                                    <div class="row" style="display: contents">
                                        <!-- Add the first additional chart -->
                                        <div class="col-lg-6 border border-4 shadow p-3 mb-5 bg-body-tertiary rounded">
                                            <h1 style="text-align: center; width: -webkit-fill-available; font-size: 30px">Consumo diario</h1>
                                            <div style="height: 500px;">
                                                <canvas id="dailyConsumptionChart"></canvas>
                                            </div>
                                        </div>

                                        <!-- Add the second additional chart -->
                                        <div class="col-lg-6 border border-4 shadow p-3 mb-5 bg-body-tertiary rounded">
                                            <h1 style="text-align: center; width: -webkit-fill-available; font-size: 30px">Consumo mensual</h1>
                                            <div style="height: 500px;">
                                                <canvas id="monthlyConsumptionChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                        <!-- Existing code as it is -->

                                        <!-- Add the third and fourth additional charts in a single row with two columns -->
                                        <div class="row" style="display: contents">
                                            <!-- Third additional chart: Consumption by Area -->
                                            <div class="col-lg-6 border border-4 shadow p-3 mb-5 bg-body-tertiary rounded">
                                                <h1 style="text-align: center; font-size: 30px">Consumo por área</h1>
                                                <div style="height: 500px;">
                                                    <canvas id="areaConsumptionChart"></canvas>
                                                </div>
                                            </div>
                                            
                                            <!-- Fourth additional chart: Top 5 Consumers -->
                                            <div class="col-lg-6 border border-4 shadow p-3 mb-5 bg-body-tertiary rounded">
                                                <h1 style="text-align: center; font-size: 30px">Top 5 Consumidores</h1>
                                                <div style="height: 500px;">
                                                    <canvas id="topConsumersChart"></canvas>
                                                </div>
                                            </div>
                                        </div>




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
                                                            label: 'Daily Consumption',
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
                                                            label: 'Monthly Consumption',
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
                                            // Predetermined data for the third additional chart (consumption by area)
                                            const areaLabels = ['Cocina', 'Cuarto', 'Sala', 'Garage', 'Sotano'];
                                            const areaData = [1200, 850, 700, 950, 1100];

                                            // Predetermined data for the fourth additional chart (top 5 consumers)
                                            const topConsumerLabels = ['Consumer A', 'Consumer B', 'Consumer C', 'Consumer D', 'Consumer E'];
                                            const topConsumerData = [550, 480, 600, 520, 540];

                                            // Create the third additional chart (consumption by area)
                                            const areaCtx = document.getElementById('areaConsumptionChart').getContext('2d');
                                            const areaConsumptionChart = new Chart(areaCtx, {
                                                type: 'doughnut',
                                                data: {
                                                    labels: areaLabels,
                                                    datasets: [{
                                                        label: 'Consuno Por Area',
                                                        data: areaData,
                                                        backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)', 'rgba(75, 192, 192, 0.6)', 'rgba(153, 102, 255, 0.6)'],
                                                        borderWidth: 1,
                                                    }]
                                                },
                                                options: {
                                                    responsive: true,
                                                    maintainAspectRatio: false,
                                                    plugins: {}
                                                }
                                            });

                                            // Create the fourth additional chart (top 5 consumers)
                                            const topCtx = document.getElementById('topConsumersChart').getContext('2d');
                                            const topConsumersChart = new Chart(topCtx, {
                                                type: 'bar',
                                                data: {
                                                    labels: topConsumerLabels,
                                                    datasets: [{
                                                        label: 'Top 5 Consumers',
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
                                                                    text: 'Consumidor' // Label for the X axis
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

                                        <!-- Existing code as it is -->

                                      
                                    </div>
                                    <script>
                                        // Función para obtener los datos del controlador
                                        function obtenerDatos() {
                                            fetch('/chart') // Ruta que apunta al método 'getData' del controlador
                                            .then(response => response.json())
                                            .then(data => {
                                                // Una vez obtenidos los datos, creamos la gráfica
                                                const meses = data.map(item => item.horas);
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
                                    
                                    
                                </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

