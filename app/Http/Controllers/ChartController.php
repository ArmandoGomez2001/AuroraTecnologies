<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;
use App\Models\ChartData;
use App\Models\SensorReading;

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
        
        $datos = DB::table('reading')
            ->whereBetween('date', [$fechaInicio, $fechaFin])
            ->orderBy('date')
            ->get();
        
        // $consumptionData = DB::table('consumo_ubicacion')->get();

        $lecturaSensor = DB::table('sensorReading')->get();
        
        $nombres = SensorReading::select('name_aparato')->distinct()->pluck('name_aparato');

        // Mover esta línea fuera del bloque anterior
        return view('home', [
            'nombres' => $nombres,
            'datos' => $datos,
            // 'consumptionData' => $consumptionData,
            'lecturaSensor' => $lecturaSensor,
            
        ]);
    }
    

    
}
