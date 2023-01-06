<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Book\DestroyBookAction;
use App\Actions\Book\IndexBookAction;
use App\Actions\Book\ShowBookAction;
use App\Actions\Book\StoreBookAction;
use App\Actions\Book\UpdateBookAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexBookAction $indexBookAction): JsonResource
    {
        return $indexBookAction();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request, StoreBookAction $storeBookAction): JsonResource
    {
        return $storeBookAction($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, ShowBookAction $showBookAction): JsonResource
    {
        return $showBookAction($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Book $book, BookRequest $request, UpdateBookAction $updateBookAction): JsonResource
    {
        return $updateBookAction($request, $book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, DestroyBookAction $destroyBookAction): Response
    {
        return $destroyBookAction($book);
    }
}
