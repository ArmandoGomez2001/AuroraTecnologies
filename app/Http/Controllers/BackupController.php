<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;



class BackupController extends Controller
{
    // public function createBackup()
    // {
    //     DB::statement('EXEC [dbo].[sp_backup_database]');
    //     return 'Backup creado exitosamente.';
    // }
    // public function createBackup()
    // {
    //     $backupPath = storage_path('app') . '/bdproject.bak';
    //     $sqlCommand = "BACKUP DATABASE " . DB::getDatabaseName() . " TO DISK = '$backupPath' WITH NOFORMAT, INIT";

    //     DB::unprepared($sqlCommand);

    //     return redirect()->back()->with('success', 'Backup creado exitosamente.');
    // }


    public function createBackup()
    {
        // // Comando para generar el backup usando mysqldump (MySQL)
        // $command = 'mysqldump --user=admin --password=12345 bdproject > backup.sql';

        // // Ejecutar el comando
        // $process = new Process(explode(' ', $command));

        // try {
        //     $process->mustRun();

        //     // Si el comando se ejecuta correctamente, redireccionar y mostrar un mensaje
        //     return redirect()->back()->with('success', 'Backup creado exitosamente.');
        // } catch (ProcessFailedException $exception) {
        //     // Si ocurre un error al ejecutar el comando, mostrar un mensaje de error
        //     return redirect()->back()->with('error', 'Error al crear el backup: ' . $exception->getMessage());
        // }
       
 
        $spName = 'sp_backup_database';

        // Reemplaza 'your_database' con el nombre de tu base de datos
        $database = 'bdproject';

        // Reemplaza 'your_username' y 'your_password' con las credenciales de acceso a tu base de datos
        $username = 'sa';
        $password = '123';

        // Comando para ejecutar el SP utilizando sqlcmd
        $command = [
            'sqlcmd',
            '-S',
            'localhost',
            '-d',
            $database,
            '-U',
            $username,
            '-P',
            $password,
            '-Q',
            "EXEC $spName"
        ];

        // Crea el proceso con el comando
        $process = new Process($command);

        try {
            // Ejecuta el proceso y espera a que termine
            $process->mustRun();

            // Obtiene el resultado del proceso
            $result = $process->getOutput();

            // Puedes hacer algo con el resultado aquí
            return response()->json(['result' => $result]);
        } catch (ProcessFailedException $exception) {
            // Manejar cualquier excepción si ocurre algún error en el proceso
            return response()->json(['error' => $exception->getMessage()]);
        }


    }

}
