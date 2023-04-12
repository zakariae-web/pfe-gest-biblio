<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class UserController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('users');

        Excel::import(new UsersImport, $file);

        return redirect()->back()->with('success', 'Data imported successfully.');
    }
}
