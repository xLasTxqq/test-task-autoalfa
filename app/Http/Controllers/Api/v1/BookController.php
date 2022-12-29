<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Book\DestroyBookAction;
use App\Actions\Book\ReadBookAction;
use App\Actions\Book\ShowBookAction;
use App\Actions\Book\StoreBookAction;
use App\Actions\Book\UpdateBookAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReadBookAction $readBookAction):Response
    {
        return response($readBookAction());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request, StoreBookAction $storeBookAction):Response
    {
        return response($storeBookAction($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, ShowBookAction $showBookAction): Response
    {
        return response($showBookAction($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, $id, UpdateBookAction $updateBookAction):Response
    {
        return response($updateBookAction($request, $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DestroyBookAction $destroyBookAction):Response
    {
        return response($destroyBookAction($id));
    }
}
