<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Models\backup;

class BackupController extends Controller
{
     public function createBackup(Request $request)
    {
       
        Artisan::call('backup:sqlserver');

        return redirect()->back()->with('success', 'Database backup completed successfully.');
    }
}
