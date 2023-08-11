<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;


class RestoreController extends Controller
{
    // public function index()
    // {
    //     return view('restore');
    // }

    // public function execute(Request $request)
    // {
    //     $backupFile = $request->input('backupFile');

    //     Artisan::call('restore:sqlserver', [
    //         'backupFile' => $backupFile,
    //     ]);

    //     return response()->json([
    //         'message' => 'Database restoration started. Check your console for progress.',
    //     ]);
    // }

    public function index()
    {
        return view('config.index'); // Cambia 'restore' por el nombre de tu vista
    }

    public function execute(Request $request)
    {
        try {
            $backupFile = $request->input('backupFile');
            $command = "restore:sqlserver $backupFile"; // Cambia esto según la firma del comando en tu clase RestoreSqlServer
            Artisan::call($command);

            return response()->json([
                'success' => true,
                'message' => 'La restauración de la base de datos se completó exitosamente.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al intentar restaurar la base de datos.',
            ], 500);
        }
    }

}
