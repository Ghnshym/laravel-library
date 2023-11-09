<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'payment_id',
        'entity',
        'amount',
        'currency',
        'lending_id',
    ];

    public function lending()
    {
        return $this->belongsTo(Lending::class);
    }
}
