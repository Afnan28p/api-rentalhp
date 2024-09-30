<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // Add other fields as needed
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
