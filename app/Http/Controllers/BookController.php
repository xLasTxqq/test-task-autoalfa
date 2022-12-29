<?php

namespace App\Http\Controllers;

use App\Actions\Book\CreateBookAction;
use App\Actions\Book\DestroyBookAction;
use App\Actions\Book\ReadBookAction;
use App\Actions\Book\StoreBookAction;
use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReadBookAction $readBookAction)
    {
        return Inertia::render('Books', $readBookAction());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateBookAction $createBookAction)
    {
        
        return Inertia::render('CreateBook',$createBookAction());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request, StoreBookAction $storeBookAction)
    {
        $storeBookAction($request);
        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::with(['comments'=>fn($query)=>$query->with('user'),'genres','authors','publishers', 
        'grades'=>fn($query)=>$query->where('user_id',auth()->id())])->withAvg('grades','stars')->findOrFail($id);
        // dd($book);
        return Inertia::render('ShowBook', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DestroyBookAction $destroyBookAction)
    {
        $destroyBookAction($id);
        return back();
    }
}
