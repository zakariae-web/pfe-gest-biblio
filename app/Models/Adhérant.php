<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adhérant extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'user_password',
        'user_name',
        'card_number',
        'adresse',
        'nombre_livres_empruntes',
        'departement',
        'date_registered',
        'date_expiration',
        'is_active',
    ];

}
