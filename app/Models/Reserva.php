<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reserves';

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function joc()
    {
        $this->belongsTo(Joc::class);
    }
}
