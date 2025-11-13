<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Transaction;
use App\Models\Balance;
use App\Models\Category;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime'
        ];
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function balance(): HasOne
    {
        return $this->hasOne(Balance::class);
    }

    public function balanceAmount()
    {
        return $this->balance?->amount;
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function note()
    {
        return $this->hasOne(Note::class);
    }

}
