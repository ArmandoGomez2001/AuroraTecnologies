@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Registros de Respaldos</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tipo de Backup</th>
                        <th>Fecha de Backup</th>
                        <th>Ruta de Archivo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registros as $registro)
                    <tr>
                        <td>{{ $registro->tipoBackup }}</td>
                        <td>{{ $registro->fechaBackup }}</td>
                        <td>{{ $registro->rutaArchivo }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection