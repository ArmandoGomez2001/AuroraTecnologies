<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class BackupController extends Controller
{

    public function createBackup()
    {
    
        // Comando para ejecutar el SP utilizando sqlcmd
        $command = [
            'sqlcmd',
            '-S',
            'localhost', 
            '-U',
            'sa',  
            '-P',
            '123',      
            '-d',
            'bdproject',
            '-Q',
            "EXEC sp_backup_database"
        ];

        // Crea el proceso con el comando
        $process = new Process($command);

        //     // Ejecuta el proceso y espera a que termine
        // $process->run();

        // // Obtiene el resultado del proceso
        // $output = $process->getOutput();

        // //return response ($output);
        // return response()->json(['result' => $output]);


        $process->run();

        // Verificar si el proceso fue exitoso o no
        if (!$process->isSuccessful()) {
            // Si el proceso falló, lanzar una excepción o manejar el error según tus necesidades.
            throw new ProcessFailedException($process);
        }

        // Obtiene el resultado del proceso
        $output = $process->getOutput();

       
    }

}
