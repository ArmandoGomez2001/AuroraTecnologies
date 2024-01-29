<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChartData;
use App\Models\SensorReading;
use App\Models\Reading;

class ChartController extends Controller
{
    public function getData()
    {
        $data = ChartData::all(); // Reemplaza 'ChartData' con el modelo que representa tus datos en la base de datos

        return response()->json($data);
    }
    // public function mostrarGrafica()
    // {
    //     $datos = DB::table('datos')
    //                 ->whereBetween('fecha', ['2023-01-01', '2023-12-31'])
    //                 ->orderBy('fecha')
    //                 ->get();

    //     return view('/home', ['datos' => $datos]);

    //}
    public function filtrarFechas(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        $datos = DB::table('reading')
            ->whereBetween('date', [$fechaInicio, $fechaFin])
            ->orderBy('date')
            ->get();

        // $consumptionData = DB::table('consumo_ubicacion')->get();
        $userId = $userId = Auth::id();
        $year = Carbon::now()->year;
        $tarifaResults  = DB::select('CALL TarifaCiclo(?)', array($userId));
        $lecturaSensor = DB::table('sensorreading')->get();
        $userConsumption = DB::table('kwh_user')->get();
        $kwh = round($userConsumption[0]->kwh);

        $nombres = SensorReading::select('nombre')->distinct()->pluck('nombre');

        if (!empty($tarifaResults)) {
            $tarifa = $tarifaResults[0];
            $bill = DB::select('CALL test5(?, ?, ?, ?, ?)', array($kwh, $tarifa->idtarifa, 1, $year, $tarifa->ciclo_facturacion));
        }




        $user = auth()->user();

        // Si el usuario es un administrador, muestra todas las gráficas
        if ($user->hasRole('Administrador')) {
            $dataRead = DB::table('sensores')
                ->join('reading', 'sensores.code_sensor', '=', 'reading.code_sensor')
                ->join('users', 'sensores.usuario', '=', 'users.id')
                ->select('users.name', 'reading.code_sensor', 'reading.date', 'sensores.name_aparato', DB::raw('SUM(reading.kw_per_day) as total_kw'))
                ->groupBy('users.name', 'reading.code_sensor', 'reading.date', 'sensores.name_aparato')
                // ->join('users', 'sensores.usuario', '=', 'users.id')
                // ->select('users.id', 'users.name as user_name', 'sensores.usuario', 'sensores.name_aparato', DB::raw('SUM(reading.kw_per_day) as total_kw'))
                // ->groupBy('users.id', 'users.name', 'sensores.usuario','sensores.name_aparato')
                ->get();
        } else {
            // Si el usuario es un usuario regular, muestra solo sus gráficas
            $userId = $user->id;

            $dataRead = DB::table('sensores')
                ->join('reading', 'sensores.code_sensor', '=', 'reading.code_sensor')
                ->join('users', 'sensores.usuario', '=', 'users.id')
                ->where('sensores.usuario', $userId)
                ->select('users.name', 'reading.code_sensor', 'reading.date', 'sensores.name_aparato', DB::raw('SUM(reading.kw_per_day) as total_kw'))
                ->groupBy('users.name', 'reading.code_sensor', 'reading.date', 'sensores.name_aparato')
                // ->select('sensores.name_aparato', DB::raw('SUM(reading.kw_per_day) as total_kw'))
                // ->groupBy('sensores.name_aparato')
                ->get();
        }

        // $lecturaRead = DB::table('reading')->get();
        // $name_aparato = SensorReading::select('nombre')->distinct()->pluck('nombre');

        // $datosConsumo = DB::table('consumo_ubicacion')
        // ->whereBetween('fecha', ['2023-1-1', '2023-12-31'])
        // ->orderBy('fecha')
        // ->get();


        // $datosConsumo24 = DB::table('consumo_ubicacion')
        // ->whereBetween('fecha', ['2024-1-1', '2024-12-31'])
        // ->orderBy('fecha')
        // ->get();


        // Mover esta línea fuera del bloque anterior
        return view('home', [
            'nombres' => $nombres,
            'datos' => $datos,
            //'consumptionData' => $consumptionData,
            'userConsumption' => $userConsumption,
            'lecturaSensor' => $lecturaSensor,
            'bill' => $bill,
            'dataRead' => $dataRead,
            // 'datosConsumo' => $datosConsumo,
            // 'datosConsumo24' => $datosConsumo24



            //  'name_aparato' => $name_aparato,
            // 'lecturaRead' => $lecturaRead,

        ]);
    }
}
