<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RestoreSqlServer extends Command
{

    protected $signature = 'restore:sqlserver {backupFile}';
    protected $description = 'Restore the SQL Server database from a backup file';

    public function handle()
    {
        $database = config('database.connections.sqlsrv.database');
        $username = config('database.connections.sqlsrv.username');
        $password = config('database.connections.sqlsrv.password');
        $host = config('database.connections.sqlsrv.host');
        $port = config('database.connections.sqlsrv.port');

        $dropCommand = "sqlcmd -S $host,$port -U $username -P $password -Q \"USE master; ALTER DATABASE $database SET SINGLE_USER WITH ROLLBACK IMMEDIATE; DROP DATABASE $database;\"";
        exec($dropCommand);

        $backupFile = $this->argument('backupFile');
        $command = "sqlcmd -S $host,$port -U $username -P $password -Q \"RESTORE DATABASE $database FROM DISK='$backupFile' WITH FILE = 1, NOUNLOAD, STATS = 20\"";
        
        exec($command);

        $this->info("Database restored successfully from: $backupFile");
    }
 
}
