<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'idUser', 'idGame',

    ];
    public function games()
    {
        return $this->belongsTo(Game::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Mensaje::class);
    }
}
