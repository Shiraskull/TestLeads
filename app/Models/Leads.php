<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    protected $fillable = [
        'nomor',
        'tanggal',
        'nama',
        'nohp',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kota',
        'tipe',
        'warna',
        'hargajual',
        'discount',
        'status',];
}
