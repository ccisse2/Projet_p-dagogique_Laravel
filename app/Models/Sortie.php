<?php

namespace App\Models;

use Database\Factories\SortieFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sortie extends Model
{
    /** @use HasFactory<SortieFactory> */
    use HasFactory;
    protected $fillable = [
        'nom', 'dateHeureDebut', 'duree', 'dateLimiteInscription', 'nbInscriptionsMax', 'infosSortie', 'etat_id',
        'lieu_id', 'campus_id', 'organisateur_id'
    ];

    public function etat(){
        return $this->belongsTo(Etat::class);
    }

    public function lieu(){
        return $this->belongsTo(Lieu::class);
    }

    public function campus(){
        return $this->belongsTo(Campus::class);
    }

    public function organisateur(){
        return $this->belongsTo(Participant::class, 'organisateur_id');
    }

    public function participants(){
        return $this->belongsToMany(Participant::class, 'participant_sortie');
    }

    protected $casts = [
        'dateHeureDebut' => 'datetime',
        'dateLimiteInscription' => 'datetime',
    ];

}
