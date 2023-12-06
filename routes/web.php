<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BackupController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ChartdateController;
use App\Http\Controllers\SensorController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RestoreController;



use App\Http\Controllers\ConfigController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/backup', function () {
//     return view('backup');
// });

// Route::get('/backup', function () {
//     try {
//         Artisan::call('backup:sqlserver');
//         $registros = DB::table('db.RegistroBackups')->get();
//         return view('config.respaldar', compact('registros'));
//         //return redirect()->back()->with('success', 'Database backup completed successfully.');
//         //return view('config.respaldar');
//     } catch (\Exception $e) {
//         return redirect()->back()->with('error', 'Database backup failed: ' . $e->getMessage());
//     }
// })->name('backup.sqlserver');

Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
Route::get('/backup/execute', [BackupController::class, 'execute'])->name('execute.backup');


Route::get('/restore', [RestoreController::class, 'index'])->name('restore.index');
Route::post('/restore/execute', [RestoreController::class, 'execute'])->name('execute.restore');



Route::get('/chart', [ChartController::class, 'getData']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('/home', [ChartController::class, 'filtrarFechas']);

Route::middleware(['auth'])->group(function () {
    // Route::get('/home', [ChartController::class, 'filtrarFechas']);
    Route::get('/home', [ChartController::class, 'filtrarFechas'])->name('filtrar-fechas');

    
});
// Route::post('/intervaloTemporal', [ChartController::class, 'intervaloTemporal']);

// Route::get('/home', [ChartController::class, 'index']);
// Route::middleware(['auth'])->group(function () {
//     Route::get('/home', [ChartController::class, 'index']);
// });


// Route::get('/home', [ChartdateController::class, 'index'])->name('chartdate');
// Route::get('/home', [ChartdateController::class, 'index']);

// $user = auth()->user();
// $isAdmin = $user->hasRole('Administrador');


//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('sensors', SensorController::class);

});




    //Route::resource('config', ConfigController::class);
Route::get('/config', [ConfigController::class, 'index'])->name('config.index');
Route::get('/config/respaldar', [ConfigController::class, 'respaldar'])->name('config.respaldar');
Route::get('/config/restaurar', [ConfigController::class, 'restaurar'])->name('config.restaurar');
Route::get('config/restaurar', function () {abort(404);})->name('config.restaurar');


// Route::get('/restore/{backupFile}', function ($backupFile) {
//     Artisan::call('restore:sqlserver', [
//         'backupFile' => $backupFile,
//     ]);

//     return redirect()->back()->with('success', 'Database restored successfully.');
// })->name('restore.sqlserver');
