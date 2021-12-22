<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'userName', 'password', 'role', 'steamUserName'

    ];

    public function parties()
    {
        return $this->hasMany(Party::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
