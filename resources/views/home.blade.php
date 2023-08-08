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
                                <div class="row">
                                    <h1 style="text-align: center; width: -webkit-fill-available; font-size: 30px">Medicion de KW</h1>
                                    <div style="width: 80%; margin: auto; height: 500px;">
                                     
                                        <canvas id="lineChart"></canvas>

                                      
                                    </div>

                                      
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
                                                            y: {
                                                     
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

