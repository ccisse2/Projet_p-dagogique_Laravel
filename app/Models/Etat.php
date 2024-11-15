<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etat extends Model
{
    protected $fillable = [
      'libelle'
    ];

    public function sorties(){
        return $this->hasMany(Sortie::class);
    }
}
