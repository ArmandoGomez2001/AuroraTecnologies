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
                                    
                                    <div style="width: 80%; margin: auto;">
                                        <canvas id="lineChart"></canvas>
                                        
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
                                                            borderWidth: 3,
                                                            fill: false
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
                                                            title: {
                                                                display: true,
                                                                text: 'KW por hora', // Set the title text
                                                                font: {
                                                                    size: 16, // Set the font size for the title
                                                                    weight: 'bold' // Set the font weight for the title
                                                                }
                                                            }
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

