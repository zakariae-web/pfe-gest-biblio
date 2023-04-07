<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('book.index',
    ['book' => Book::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = new Book();

        $book->title =$request->input('title');
        $book->author =$request->input('author');
        $book->publication_date =$request->input('publication_date');

        $book->save();
        return redirect()->route('book.index');
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
        $book = Book::findorfail($id);
        return view('book.edit', [
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findorfail($id);

        $book->title =$request->input('title');
        $book->author =$request->input('author');
        $book->publication_date =$request->input('publication_date');

        $book->save();
        return redirect()->route('book.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findorfail($id);
        $book->delete();
        return redirect()->route('book.index');
    }
}
