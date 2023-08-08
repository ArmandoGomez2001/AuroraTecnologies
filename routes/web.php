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
Route::get('/backup', function () {
    return view('backup');
});

Route::post('/backup', function () {
    try {
        Artisan::call('backup:sqlserver');
        return redirect()->back()->with('success', 'Database backup completed successfully.');
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




