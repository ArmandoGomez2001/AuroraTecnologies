<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Models\backup;

class BackupController extends Controller
{

    // public function createBackup()
    // {
    //     $sqlcmdPath = 'C:\Program Files\Microsoft SQL Server\Client SDK\ODBC\170\Tools\Binn\SQLCMD.EXE';

    //     // Comando para ejecutar el SP utilizando sqlcmd
    //     $command = [
    //         $sqlcmdPath,
    //         '-S',
    //         'localhost', 
    //         '-U',
    //         'sa',  
    //         '-P',
    //         '123',      
    //         '-d',
    //         'bdproject',
    //         '-q',
    //         "exec dbo.dbbackup"
    //     ];

    //     // Crea el proceso con el comando
    //     $process = new Process($command);

    //     // Ejecuta el proceso y espera a que termine
    //     $process->run();

    //     // Verificar si el proceso fue exitoso o no
    //     if (!$process->isSuccessful()) {
    //         // Si el proceso falló, lanzar una excepción o manejar el error según tus necesidades.
    //         throw new ProcessFailedException($process);
    //     }

    //     // Obtiene el resultado del proceso
    //     $output = $process->getOutput();

    //     // Devuelve la salida del proceso
    //     return response()->json(['result' => $output]);
    // }
    public function createBackup()
    {
        $sqlcmdPath = 'C:\Program Files\Microsoft SQL Server\Client SDK\ODBC\170\Tools\Binn\sqlcmd';

        // Comando para ejecutar el SP utilizando sqlcmd
        $command = [
            $sqlcmdPath,
            '-S',
            'localhost', 
            '-d',
            'bdproject',
            '-U',
            'sa',
            '-P',
            '123',
            '-q',
            'exec dbo.dbbackup'
        ];

        // Crea el proceso con el comando
        $process = new Process($command);

        // Ejecuta el proceso y espera a que termine
        $process->run();

        // Verifica si el proceso fue exitoso o no
        if (!$process->isSuccessful()) {
            // Si el proceso falló, obtener el mensaje de error.
            $errorOutput = $process->getErrorOutput();
            throw new ProcessFailedException($process, $errorOutput);
        }

        // Obtiene el resultado del proceso
        $output = $process->getOutput();

        // Devuelve la salida del proceso
        return response()->json(['result' => $output]);
    }

}
