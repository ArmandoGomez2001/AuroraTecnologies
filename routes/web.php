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
use App\Http\Controllers\SensorController;
use Illuminate\Support\Facades\DB;


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
    return view('auth.login');
});
// Route::get('/backup', function () {
//     return view('backup');
// });

Route::get('/backup', function () {
    try {
        Artisan::call('backup:sqlserver');
        $registros = DB::table('db.RegistroBackups')->get();
        return view('config.respaldar', compact('registros'));
        //return redirect()->back()->with('success', 'Database backup completed successfully.');
        //return view('config.respaldar');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Database backup failed: ' . $e->getMessage());
    }
})->name('backup.sqlserver');


Route::get('/chart', [ChartController::class, 'getData'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
