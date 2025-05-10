<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'nama',
        'dataUnik',
        'type',
        'kolom',
        'SelectTipe',
        'checkboxValues',
        'range',
        'date',
    ];

    // Mengonversi kolom json menjadi array
    protected $casts = [
        'dataUnik' => 'array',
        'kolom' => 'array',
        'SelectTipe' => 'array',
        'checkboxValues' => 'array',
        'range' => 'array',
        'date' => 'array',
    ];
}
