<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Réservation extends Model
{
    use HasFactory;

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function adherant()
    {
        return $this->belongsTo(Adhérant::class);
    }

    public function emprunt()
    {
        return $this->hasOne(Emprunt::class);
    }
}
