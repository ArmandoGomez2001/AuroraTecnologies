@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Configuracion</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="backup">
                            <details>
                                <summary>Avanzado</summary>
                                <div class="row">
                                    <a id="proceder" class="btn btn-light" href="{{ route('config.restaurar') }}">Respaldar</a>
                                    
                                    <label for="archivoInput" class="btn btn-dark">Restaurar</label>
                                    <input type="file" id="archivoInput" style="display:none;">
                                    <label id="nombreArchivoLabel" ></label>

                                    <a id="botonRestore" class="btn btn-success" style="display:none;">Respaldar archivo seleccionado</a>

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
    // Script para manejar el botón "Guardar" del formulario
    document.addEventListener('DOMContentLoaded', function () {
        const respaldar = document.querySelector('.btn-light');
        if (respaldar) {
            respaldar.addEventListener('click', (event) => {
                event.preventDefault();
                // Mostrar la confirmación de SweetAlert2 antes de enviar el formulario
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¿Deseas realizar un respaldo de la base datos?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Respaldar la base de datos'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si se confirma, enviar el formulario
                        window.location.href="{{ route('backup.sqlserver') }}";
                    }
                });
            });
        }
    });
</script>


<script>
    document.getElementById('archivoInput').addEventListener('change', function() {
      const archivoInput = document.getElementById('archivoInput');
      const nombreArchivoLabel = document.getElementById('nombreArchivoLabel');
      const botonRestore = document.getElementById('botonRestore');

      if (archivoInput.files.length > 0) {
        const nombreCompleto = archivoInput.files[0].name;
        const nombreSinExtension = nombreCompleto.replace(/\.[^.]*$/, ''); // Remover la extensión
        nombreArchivoLabel.textContent = nombreSinExtension;
        botonRestore.style.display = 'block';
      }
    });
</script>

@endsection


