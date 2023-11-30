<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 


class ChartdateController extends Controller
{
    public function index($interval = 'daily') // Asume daily como valor predeterminado
    {
        // Define el intervalo de tiempo en la consulta SQL
        $timeInterval = 'DAY'; // Puedes ajustar esto según tu estructura de datos

        if ($interval === 'weekly') {
            $timeInterval = 'WEEK';
        } elseif ($interval === 'monthly') {
            $timeInterval = 'MONTH';
        } elseif ($interval === 'yearly') {
            $timeInterval = 'YEAR';
        }

        // Consulta SQL con el intervalo de tiempo seleccionado
        // $sensorReadings = DB::select("SELECT se.name_aparato, 
        //                                 AVG(re.kw_per_day) as avg_kw_per_day
        //                               FROM sensorReading se
        //                               INNER JOIN reading re ON se.code_sensor = re.code_sensor
        //                               GROUP BY se.name_aparato, DATE_TRUNC('$timeInterval', re.date)");
        $sensorReadings = DB::select("SELECT se.name_aparato, 
                                    AVG(re.kw_per_day) as avg_kw_per_day
                                  FROM sensorReading se
                                  INNER JOIN reading re ON se.code_sensor = re.code_sensor
                                  GROUP BY se.name_aparato, DATE_FORMAT(re.date, '%Y-%m-%d')");


        return view('home', compact('sensorReadings', 'interval'));
    }
}
