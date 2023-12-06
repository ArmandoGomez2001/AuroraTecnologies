<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    use HasFactory;
    protected $table = 'reading'; 
    protected $fillable = [
        'id', 'code_sensor', 'kw_per_day', 'date' // Asegúrate de incluir todas las columnas que necesitas
    ];
}
