@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Sensor</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">                            
                   
                        @if ($errors->any())                                                
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>                        
                                @foreach ($errors->all() as $error)                                    
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach                        
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif


                    <form action="{{ route('sensors.update',$sensor->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="code_sensor">Code Sensor</label>
                                   <input type="text" name="code_sensor" class="form-control" value="{{ $sensor->code_sensor }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="usuarios">Usuario</label>
                                    {!! Form::select('usuario', $usuarios, null, array('class' => 'form-control')) !!}
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="name_aparato">Name aparato</label>
                                   <input type="text" name="name_aparato" class="form-control" value="{{ $sensor->name_aparato }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                    
                                <div class="form-floating">
                                    <label for="ubicacion">Ubicacion</label>
                                    <input type="text" name="ubicacion" class="form-control" value="{{ $sensor->ubicacion }}" >
                                </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Guardar</button>                            
                        </div>
                    </form>

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
        const saveButton = document.querySelector('.btn-primary');
        if (saveButton) {
            saveButton.addEventListener('click', (event) => {
                event.preventDefault();
                // Mostrar la confirmación de SweetAlert2 antes de enviar el formulario
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¿Deseas editar este sensor?',
                    icon: 'alert',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Guardar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si se confirma, enviar el formulario
                        const form = event.target.closest('form');
                        form.submit();
                    }
                });
            });
        }
    });
</script>
@endsection