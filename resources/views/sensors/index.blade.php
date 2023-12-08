@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Sensores</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                
            
                        @can('crear-sensor')
                        <a class="btn btn-warning" href="{{ route('sensors.create') }}">Nuevo</a>
                        @endcan
            
                        <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                     
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Ubicacion</th>                                    
                                    <th style="color:#fff;">Acciones</th>                                                                   
                              </thead>
                              <tbody>
                            @foreach ($sensors as $sensor)
                            <tr>
                                <td style="display: none;">{{ $sensor->id }}</td>                                
                                <td>{{ $sensor->name_aparato }}</td>
                                <td>{{ $sensor->ubicacion }}</td>
                                {{-- <td>
                                    <form action="{{ route('sensors.destroy',$sensor->id) }}" method="POST">                                        
                                        @can('editar-sensor')
                                        <a class="btn btn-info" href="{{ route('sensors.edit',$sensor->id) }}">Editar</a>
                                        @endcan

                                        @csrf
                                        @method('DELETE')
                                        @can('borrar-sensor')
                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                        @endcan

                                        
                                    </form>
                                </td> --}}

                                <td>                                
                                    @can('editar-sensor')
                                        <a class="btn btn-primary" href="{{ route('sensors.edit', $sensor->id) }}">Editar</a>
                                    @endcan
                                    
                                    @can('borrar-sensor')
                                    <button class="btn btn-danger delete-button" data-id="{{ $sensor->id }}">Borrar</button>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Ubicamos la paginacion a la derecha -->
                        <div class="pagination justify-content-end">
                            {!! $sensors->links() !!}
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
  // Script para manejar el botón "Borrar" del formulario
  document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach((button) => {
      button.addEventListener('click', (event) => {
        event.preventDefault();
        const userId = event.target.getAttribute('data-id');
        // Mostrar la confirmación de SweetAlert2 antes de enviar el formulario
        Swal.fire({
          title: '¿Estás seguro?',
          text: 'No podrás revertir la siguiente acción.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: '¡Sí, bórrala!'
        }).then((result) => {
          if (result.isConfirmed) {
            // Si se confirma, enviar el formulario
            const deleteForm = document.createElement('form');
            deleteForm.method = 'POST';
            deleteForm.action = '{{ route('sensors.destroy', '') }}/' + userId;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            deleteForm.appendChild(csrfInput);
            deleteForm.appendChild(methodInput);
            document.body.appendChild(deleteForm);
            deleteForm.submit();
          }
        });
      });
    });
  });
</script>
@endsection