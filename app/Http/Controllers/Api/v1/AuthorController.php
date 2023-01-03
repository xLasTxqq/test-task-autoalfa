<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Author\DestroyAuthorAction;
use App\Actions\Author\IndexAuthorAction;
use App\Actions\Author\ShowAuthorAction;
use App\Actions\Author\StoreAuthorAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexAuthorAction $indexAuthorAction): JsonResource
    {
        return $indexAuthorAction();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorRequest $request, StoreAuthorAction $storeAuthorAction): JsonResource
    {
        return $storeAuthorAction($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author, ShowAuthorAction $showAuthorAction): JsonResource
    {
        return $showAuthorAction($author);
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
    public function destroy(Author $author, DestroyAuthorAction $destroyAuthorAction)
    {
        return $destroyAuthorAction($author);
    }
}
