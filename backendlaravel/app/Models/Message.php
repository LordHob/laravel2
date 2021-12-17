<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'idUser', 'idParty', 'message'

    ];
    public function parties()
    {
        return $this->belongsTo(Party::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
