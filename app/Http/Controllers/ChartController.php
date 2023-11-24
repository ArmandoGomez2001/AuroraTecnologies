<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChartData;

class ChartController extends Controller
{
    public function getData()
    {
        $data = ChartData::all(); // Reemplaza 'ChartData' con el modelo que representa tus datos en la base de datos

        return response()->json($data);
    }

     public function filtrarFechas(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
    
        $datos = DB::table('predicted_energy_consumption')
            ->whereBetween('timestamp', [$fechaInicio, $fechaFin])
            ->orderBy('timestamp')
            ->get();
    
        $consumptionData = DB::table('consumo_ubicacion')->get();
        \Log::info($consumptionData); // Add this line to log data
    
        return view('home', ['datos' => $datos, 'consumptionData' => $consumptionData]);
    }

}
