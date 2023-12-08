<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 


class ChartdateController extends Controller
{
    // public function index($interval = 'daily') // Asume daily como valor predeterminado
    // {
    //     // Define el intervalo de tiempo en la consulta SQL
    //     $timeInterval = 'DAY'; // Puedes ajustar esto según tu estructura de datos

    //     if ($interval === 'weekly') {
    //         $timeInterval = 'WEEK';
    //     } elseif ($interval === 'monthly') {
    //         $timeInterval = 'MONTH';
    //     } elseif ($interval === 'yearly') {
    //         $timeInterval = 'YEAR';
    //     }

    //     $sensorReadings = DB::select("SELECT se.name_aparato, 
    //                                 AVG(re.kw_per_day) as avg_kw_per_day
    //                               FROM sensorReading se
    //                               INNER JOIN reading re ON se.code_sensor = re.code_sensor
    //                               GROUP BY se.name_aparato, DATE_FORMAT(re.date, '%Y-%m-%d')");


    //     return view('home', compact('sensorReadings', 'interval'));
    // }
    public function index()
    {
        // Obtener los datos agrupados por usuario y name_aparato
        $data = DB::table('sensores')
            ->join('reading', 'sensores.code_sensor', '=', 'reading.code_sensor')
            ->select('sensores.usuario', 'sensores.name_aparato', DB::raw('SUM(reading.kw_per_day) as total_kw'))
            ->groupBy('sensores.usuario', 'sensores.name_aparato')
            ->get();

        return view('home', compact('data'));
    }
}
