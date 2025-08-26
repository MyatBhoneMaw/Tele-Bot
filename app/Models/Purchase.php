<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'chat_id',
        'user_name',
        'user_phone',
        'selected_plan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'chat_id', 'chat_id');
    }
}
