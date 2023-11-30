<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $table = 'sensores';

    protected $fillable = ['code_sensor','name_aparato', 'ubicacion', 'usuario'];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario');
    }
}

