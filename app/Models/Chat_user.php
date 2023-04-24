<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat_user extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'age',
        'email',
        'password'
    ];


    public function messages(): HasMany
    {
        return $this->hasMany(Chat_message::class);
    }
}
?>