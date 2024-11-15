<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{

    use HasFactory;
    protected $fillable = [
        'nom'
    ];

    public function sorties(){
        return $this->hasMany(Sortie::class);
    }

    public function participants(){
        return $this->hasMany(Participant::class);
    }
}
