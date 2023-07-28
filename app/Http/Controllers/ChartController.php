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
}
