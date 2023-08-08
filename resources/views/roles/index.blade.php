@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Roles</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
        
                        @can('crear-rol')
                        <a class="btn btn-warning" href="{{ route('roles.create') }}">Nuevo</a>                        
                        @endcan
        
                
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">Rol</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>  
                                <tbody>
                                @foreach ($roles as $role)
                                <tr>                           
                                    <td>{{ $role->name }}</td>
                                    <td>                                
                                        @can('editar-rol')
                                            <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Editar</a>
                                        @endcan
                                        
                                        @can('borrar-rol')
                                        <button class="btn btn-danger delete-button" data-id="{{ $role->id }}">Borrar</button>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>               
                            </table>

                            <!-- Centramos la paginacion a la derecha -->
                            <div class="pagination justify-content-end">
                                {!! $roles->links() !!} 
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
            deleteForm.action = '{{ route('roles.destroy', '') }}/' + userId;
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
