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
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                        <label for="titulo">Restaurar/label>
                                        <input type="text" name="titulo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">                    
                                        <div class="form-group">
                                            <label for="titulo">Dirección IP</label>
                                            <input type='text' id='idIP' name='ip'  class='form-control' value="" size='20' maxlength='15' title='Dirección IP'>                                </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">                    
                                        <div class="form-group">
                                            <label for="" class="control-label">Grupo</label>
                                            <select name="grupo_id" id="grupo_id" class="custom-select custom-select-sm select2" required>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Guardar</button>                            
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