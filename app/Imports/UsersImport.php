<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Adhérant;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    public function model(array $row)
    {
        $card_number = 'ADH' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);

        $user = User::create([
            'name' => $row[0],
            'email' => $row[1],
            'password' => Hash::make($row[2]),
            'role' => $row[3],
            'card_number' => $card_number,
        ]);

        $user->adherant()->create([
            'card_number' => $card_number,
            'adress' => '',
            'nombre_livres_empruntes' => 0,
            'departement' => '',
            'date_registered' => now(),
            'date_expiration' => now()->addYear(),
            'is_active' => true,
        ]);

        return $user;
    }
}