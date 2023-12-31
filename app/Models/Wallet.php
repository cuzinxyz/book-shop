<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'credits', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
