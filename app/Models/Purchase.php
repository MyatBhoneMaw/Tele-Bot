<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'chat_id',
        'user_name',
        'user_phone',
        'selected_plan',
        'payment_status'
    ];

      protected $casts = [
        'payment_status' => PaymentStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'chat_id', 'chat_id');
    }
}
