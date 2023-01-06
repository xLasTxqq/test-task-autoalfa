<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Publisher\DestroyPublisherAction;
use App\Actions\Publisher\IndexPublisherAction;
use App\Actions\Publisher\ShowPublisherAction;
use App\Actions\Publisher\StorePublisherAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\PublisherRequest;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexPublisherAction $indexPublisherAction): JsonResource
    {
        return $indexPublisherAction();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublisherRequest $request, StorePublisherAction $storePublisherAction): JsonResource
    {
        return $storePublisherAction($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher, ShowPublisherAction $showPublisherAction): JsonResource
    {
        return $showPublisherAction($publisher);
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
    public function destroy(Publisher $publisher, DestroyPublisherAction $destroyPublisherAction): Response
    {
        return $destroyPublisherAction($publisher);
    }
}
