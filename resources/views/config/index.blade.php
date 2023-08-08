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
                                    <a id="proceder" class="btn btn-light">Respaldar</a>
                                    <a class="btn btn-light" href="{{ route('config.restaurar') }}">Restaurar</a>                                   
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
@endsection


