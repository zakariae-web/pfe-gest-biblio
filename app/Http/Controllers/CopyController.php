<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Copie;

class CopyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('copie.index',
        ['copie' => Copie::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('copie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $copie = new Copie();

        $copie->document_id = $request->input('document_id');
        $copie->cote = $request->input('cote');
        $copie->disponible = true;
        
        $copie->save();
        return redirect()->route('copie.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $copie = Copie::findorfail($id);
        return view('copie.edit', [
            'copie' => $copie
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $copie = Copie::findorfail($id);

        
        $copie->document_id = $request->input('document_id');
        $copie->cote = $request->input('cote');
        $copie->disponible = true;
        
        $copie->save();
        return redirect()->route('copie.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $copie = Copie::findorfail($id);
        $copie->delete();
        return redirect()->route('copie.index');
    }
}
