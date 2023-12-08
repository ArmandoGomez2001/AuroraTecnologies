<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorReading extends Model
{
    use HasFactory;

    protected $table = 'sensorReading'; 
    protected $fillable = [
        'date', 'kwh', 'nombre' // Asegúrate de incluir todas las columnas que necesitas
    ];
}
