<?php

namespace App\Http\Controllers;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    public function index(){
        return view('config.index');
    }
    /*
    public function respaldar(){
        try
        {
            DB::select('EXEC RespaldoCompleto');

            // Obtener registros de la tabla RegistroBackups
            $registros = DB::table('db.RegistroBackups')->get();
        
            return view('config.respaldar', compact('registros'));
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
        //return view('config.respaldar');
    }
    */

    public function respaldar(){
        // Obtener las credenciales de base de datos de las variables de entorno
        $dbUser = getenv('DB_USERNAME');
        $dbPassword = getenv('DB_PASSWORD');
        $dbName = getenv('DB_DATABASE');
        
        // Nombre o dirección del servidor de base de datos SQL Server
        $serverName = getenv('DB_HOST'); // Lee el valor de la variable DB_HOST del archivo .env

        // Construir el comando para ejecutar el Stored Procedure
        $command = [
            'sqlcmd',
            '-S', $serverName,
            '-d', $dbName,
            '-U', $dbUser,
            '-P', $dbPassword,
            '-Q', 'EXEC RespaldoCompleto'
        ];

        // Crear una nueva instancia de Process
        $process = new Process($command);
        $process ->run();
        $output = $process->getOutput();
        $registros = DB::table('db.RegistroBackups')->get();
        return view('config.respaldar', compact('registros'));
    }

    public function restaurar(){
        return view('config.restaurar');
    }
    

}
