<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ChartData;
use App\Models\SensorReading;

class ChartController extends Controller
{

    public function index()
    {
        // Obtén el usuario autenticado
        $user = auth()->user();

        // Si el usuario es un administrador, muestra todas las gráficas
        if ($user->hasRole('Administrador')) {
            $data = DB::table('sensores')
                ->join('reading', 'sensores.code_sensor', '=', 'reading.code_sensor')
                ->join('users', 'sensores.usuario', '=', 'users.id')

                ->select('users.name','sensores.name_aparato', DB::raw('SUM(reading.kw_per_day) as total_kw'))
                ->groupBy('users.name','sensores.name_aparato')
                // ->join('users', 'sensores.usuario', '=', 'users.id')
                // ->select('users.id', 'users.name as user_name', 'sensores.usuario', 'sensores.name_aparato', DB::raw('SUM(reading.kw_per_day) as total_kw'))
                // ->groupBy('users.id', 'users.name', 'sensores.usuario','sensores.name_aparato')
                ->get();
        } else {
            // Si el usuario es un usuario regular, muestra solo sus gráficas
            $userId = $user->id;

            $data = DB::table('sensores')
                ->join('reading', 'sensores.code_sensor', '=', 'reading.code_sensor')
                ->where('sensores.usuario', $userId)
                ->select('sensores.name_aparato', DB::raw('SUM(reading.kw_per_day) as total_kw'))
                ->groupBy('sensores.name_aparato')
                ->get();
        }

        return view('home', compact('data'));
    }


    public function intervaloTemporal(Request $request)
    {
        // Lógica para manejar la solicitud de intervalo temporal
        $intervalo = $request->input('intervalo');

        // Implementa la lógica para obtener datos según el intervalo seleccionado
        // Puedes usar AJAX para obtener datos del servidor o calcularlos directamente en el cliente
        // Asegúrate de ajustar la lógica según tus necesidades

        $data = []; // Obtén los datos según el intervalo

        return response()->json($data);
    }



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

        $name_aparato = SensorReading::select('name_aparato')->distinct()->pluck('name_aparato');

        // Mover esta línea fuera del bloque anterior
        return view('home', [
            'name_aparato' => $name_aparato,
            'datos' => $datos,
            // 'consumptionData' => $consumptionData,
            'lecturaSensor' => $lecturaSensor,

        ]);
    }
}
