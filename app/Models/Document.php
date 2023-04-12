<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;


    

    public function retourner()
    {
        $this->nombre_de_copies++;
        $this->save();
    }

    public function copies()
    {
        return $this->hasMany(Copie::class);
    }
    

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }


    public function emprunts()
    {
        return $this->hasMany(Emprunt::class);
    }
}
