<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'codePostal'
    ];

    public function lieux()
    {
        return $this->hasMany(Lieu::class);
    }
}
