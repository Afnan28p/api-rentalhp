<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\devices;

class rentals extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = [
        'name',
        'device_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'total_harga',
        'status'
    ];

    public function devices() {
        return $this->belongsTo(devices::class,'device_id');
    }
}
