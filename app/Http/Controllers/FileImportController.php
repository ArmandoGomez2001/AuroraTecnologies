<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileImportController extends Controller
{
    public function process(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();

            if ($extension === 'pdf') {
                $this->processPdfFile($file);
            } elseif ($extension === 'xls' || $extension === 'xlsx') {
                $this->processExcelFile($file);
            } else {
                // Manejar otros tipos de archivos si es necesario
            }

            // Mostrar el div flotante con un mensaje
            return view('config.index', ['message' => 'Archivo cargado correctamente']);
        }

        // Mostrar el div flotante con un mensaje de error
        return view('config.index', ['error' => 'Error al cargar el archivo']);
    }

    private function processPdfFile($file)
    {
        // Lógica para procesar archivos PDF
    }

    private function processExcelFile($file)
    {
        // Lógica para procesar archivos Excel
    }
}
