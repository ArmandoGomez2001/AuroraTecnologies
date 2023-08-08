<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class BackupSqlServer extends Command
{
    protected $signature = 'backup:sqlserver';
    protected $description = 'Backup the SQL Server database';

    public function handle()
    {
        $database = config('database.connections.sqlsrv.database');
        $username = config('database.connections.sqlsrv.username');
        $password = config('database.connections.sqlsrv.password');
        $host = config('database.connections.sqlsrv.host');
        $port = config('database.connections.sqlsrv.port');

        $backupPath = storage_path('app/backup');

        // Create the backup directory if it doesn't exist
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        $backupFileName = 'backup_Aurora'. date('Ymd_His') .'.bak';

        // $command = "sqlcmd -S {$host},{$port} -d {$database} -U {$username} -P {$password} -Q \"BACKUP DATABASE {$database} TO DISK='{$backupPath}/{$backupFileName}'\"";
      //  $command = "sqlcmd -S {$host},{$port} -d {$database} -U {$username} -P {$password} -Q \"EXEC dbbackup'\"";
        $command = "sqlcmd -S $host,$port -d $database -U $username -P $password -Q \"EXEC RespaldoCompleto\"";

        exec($command);

       // $this->info('Database backup created successfully: ' . $backupFileName);

        // $registros = DB::table('db.RegistroBackups')->get();
        // return view('config.respaldar', compact('registros'));

    }
}
