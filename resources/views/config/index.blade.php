@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Configuración</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="backup">
                            <details>
                                <summary>Avanzado</summary>
                                <div class="row justify-content-center text-center">
                                    <div class="col-12 my-3 d-flex justify-content-between">
                                        <a id="proceder" class="btn btn-light" >Respaldar</a>
                                        <label for="archivoInput" class="btn btn-dark">Restaurar</label>
                                        <input type="file" id="archivoInput" style="display:none;">
                                        <label id="nombreArchivoLabel"></label>
                                        <a id="botonRestore" class="btn btn-success" style="display:none;">Restaurar archivo seleccionado</a>
                                    </div>
                                </div>
                                
                                
                            </details>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>

    document.addEventListener('DOMContentLoaded', function () {
    const respaldar = document.querySelector('.btn-light');
    
    if (respaldar) {
        respaldar.addEventListener('click', async (event) => {
            event.preventDefault();
            
            const result = await Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Deseas realizar un respaldo de la base datos?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Respaldar la base de datos'
            });
            
            if (result.isConfirmed) {
                try {
                        const response = await fetch('{{ route('execute.backup') }}', {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                        });

                        const responseDatas = await response.json();
                        console.log(responseDatas);

                        if (responseDatas.success) {
                            Swal.fire({
                                title: 'Respaldo exitosa',
                                text: responseDatas.message,
                                icon: 'success'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: responseDatas.message,
                                icon: 'error'
                            });
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Ocurrió un error durante el respaldo',
                            icon: 'error'
                        });
                    }
            }
        });
    }
});
</script>


<script>
    let nombreSinExtension = '';
    document.getElementById('archivoInput').addEventListener('change', function() {
        const archivoInput = document.getElementById('archivoInput');
        const nombreArchivoLabel = document.getElementById('nombreArchivoLabel');
        const botonRestore = document.getElementById('botonRestore');

        if (archivoInput.files.length > 0) {

            nombreSinExtension = archivoInput.files[0].name.replace(/\.[^.]*$/, ''); // Remover la extensión
            botonRestore.style.display = 'block';
            nombreArchivoLabel.textContent = `Archivo seleccionado: ${nombreSinExtension}`;

            const extension = archivoInput.files[0].name.split('.').pop();
            if (extension != 'bak') {
                Swal.fire({
                    title: 'Error',
                    text: 'Por favor, selecciona un archivo con extensión .bak',
                    icon: 'error',
                    confirmButtonText: 'Cerrar'
                });
                nombreArchivoLabel.textContent = '';
                botonRestore.style.display = 'none';


            }
        }
    });

    const restaurar = document.getElementById('botonRestore');
    restaurar.addEventListener('click', async (event) => {
        event.preventDefault();

        if (nombreSinExtension) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Deseas realizar una restauración del archivo ' + archivoInput.files[0].name + '?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Restaurar la base de datos'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await fetch('{{ route('execute.restore') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ backupFile: nombreSinExtension })
                        });

                        const responseData = await response.json();
                        console.log(responseData);

                        if (responseData.success) {
                            Swal.fire({
                                title: 'Restauración exitosa',
                                text: responseData.message,
                                icon: 'success'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: responseData.message,
                                icon: 'error'
                            });
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Ocurrió un error durante la restauración',
                            icon: 'error'
                        });
                    }
                }
            });
        } else {
            Swal.fire({
                title: 'Archivo no seleccionado',
                text: 'Por favor, selecciona un archivo para restaurar',
                icon: 'warning'
            });
        }
    });
</script>
@endsection


