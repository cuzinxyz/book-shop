<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "fullname",
        "cart_orders",
        "phone_number",
        "email",
        "address",
        "address2",
        "payment_method",
        "status_order",
        "note_order",
        "cart_total",
    ];

    protected $casts = [
        "cart_orders" => "array",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
