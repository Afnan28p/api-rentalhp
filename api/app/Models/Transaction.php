<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Disposisi; 

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'disposisi_id',
        'model_hp',
        'tanggal_mulai_rental',
        'tanggal_akhir_rental',
        'jumlah',
    ];

   public function disposisi()
   {
    return $this->belongsTo(Disposisi::class);
   }
}
