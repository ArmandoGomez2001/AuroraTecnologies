<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicaciones extends Model
{
    protected $table = 'ubicacion'; 
    protected $fillable = [
        'nombre',
    ];
    
    protected $guarded = [
        'id'
    ];
}
