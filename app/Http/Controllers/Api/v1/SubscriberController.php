<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Subscriber\DestroySubscriberAction;
use App\Actions\Subscriber\StoreSubscriberAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriberRequest;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriberRequest $request, StoreSubscriberAction $storeSubscriberAction): JsonResource
    {
        return $storeSubscriberAction($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function destroy(Subscriber $subscriber, DestroySubscriberAction $destroySubscriberAction): Response
    {
        return $destroySubscriberAction($subscriber);
    }
}
