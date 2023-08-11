<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;


class BackupController extends Controller
{

    public function index()
    {
        return view('config.index'); // Cambia 'restore' por el nombre de tu vista
    }

    public function execute()
    {
        try {
            Artisan::call('backup:sqlserver');

            return response()->json([
                'success' => true,
                'message' => 'El respaldo de la base de datos se completó exitosamente.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al intentar respaldar la base de datos.',
            ], 500);
        }
    }

}
