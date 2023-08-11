@extends('layouts.app')

@section('content')
<script>
    /**
     * Función para validar una dirección ip
     * @param idElement
     */
    const validateIp = idElement => {
        const element=document.getElementById(idElement);
 
        // Patron para validar la ip
        const patronIp=new RegExp(/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/gm);
        if (element.value.search(patronIp)==0) {
            // Ip correcta
            element.style.color="#000";
        } else {
            // Ip incorrecta
            element.style.color="#f00";
        }
    }
 
    window.onload = () => {
        document.getElementById("idIP").addEventListener("keyup", e => {
            validateIp("idIP")
        });
    }
    </script>

    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Agregar dispositivo</h3>
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

                    <form action="{{ route('blogs.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="titulo">Nombre del dispositivo (microondas, refrigerador, etc...)</label>
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
                            <button type="submit" class="btn btn-primary">Agregar</button>                            
                        </div>
                    </form>
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
