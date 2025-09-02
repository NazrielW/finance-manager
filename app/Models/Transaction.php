<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use HasFactory;

    protected $fillable = [
    'user_id',
    'type',
    'amount',
    'description',
    'date'
    ];

    protected $casts = [
        'date' => 'date',
    ];
}