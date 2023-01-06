<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Genre\DestroyGenreAction;
use App\Actions\Genre\IndexGenreAction;
use App\Actions\Genre\ShowGenreAction;
use App\Actions\Genre\StoreGenreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexGenreAction $indexGenreAction): JsonResource
    {
        return $indexGenreAction();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenreRequest $request, StoreGenreAction $storeGenreAction): JsonResource
    {
        return $storeGenreAction($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre, ShowGenreAction $showGenreAction): JsonResource
    {
        return $showGenreAction($genre);
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
    public function destroy(Genre $genre, DestroyGenreAction $destroyGenreAction): Response
    {
        return $destroyGenreAction($genre);
    }
}
