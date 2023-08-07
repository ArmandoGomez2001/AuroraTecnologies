<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    public function index(){
        return view('config.index');
    }
    public function respaldar(){
        return view('config.respaldar');
    }
    public function restaurar(){
        return view('config.restaurar');
    }
    

}
