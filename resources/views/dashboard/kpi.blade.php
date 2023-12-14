<div class="card-body">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card kpi shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-chart-line fa-2x"></i> Top
                            dispositivo</h5>
                        <p class="card-text value">TV</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card kpi shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-coffee fa-lg"></i> Consumo promedio
                            diario</h5>
                        <p class="card-text value">8 Kw</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card kpi shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-dollar-sign fa-lg"></i> Gasto actual
                        </h5>
                        <p class="card-text value">

                            @foreach ($bill as $pagar)
                                {{ $pagar->Total_Pagar }}
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
