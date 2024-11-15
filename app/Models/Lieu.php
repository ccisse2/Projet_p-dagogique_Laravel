<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom', 'rue', 'latitude', 'longitude', 'ville_id'
    ];

    public function ville(){
        return $this->belongsTo(Ville::class);
    }

    public function sorties()
    {
        return $this->hasMany(Sortie::class);
    }
}
