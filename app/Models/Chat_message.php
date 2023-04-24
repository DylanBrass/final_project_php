<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Chat_message extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'image',
        'sender_id',
        'receiver_id'
    ];

    public function User(): HasOne
    {
        return $this->hasOne(Chat_user::class);
    }
}
?>