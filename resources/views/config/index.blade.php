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
                                    <a class="btn btn-light" href="{{ route('config.respaldar') }}">Respaldar</a>
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