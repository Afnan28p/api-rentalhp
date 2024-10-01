<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devices extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = [
    'nama',
    'merek_device',
    'tipe_device',
    'harga_sewa_per_hari',
    'stock',
    'status',
    ];

}
