<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat_message extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'image'
    ];

   /* public function chatUser(): BelongsTo
    {
        return $this->belongsTo(Chat_user::class);
    }*/
}
?>
