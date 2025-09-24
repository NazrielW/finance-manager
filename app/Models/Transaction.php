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
    'source',
    'date',
    'category_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}