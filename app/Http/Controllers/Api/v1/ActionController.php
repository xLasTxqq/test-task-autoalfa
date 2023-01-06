<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Action\DestroyActionsAction;
use App\Actions\Action\IndexActionsAction;
use App\Actions\Action\StoreActionsAction;
use App\Actions\Action\UpdateActionsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActionRequest;
use App\Models\Action;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexActionsAction $indexActionsAction): JsonResource
    {
        return $indexActionsAction();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActionRequest $request, StoreActionsAction $storeActionsAction): JsonResource
    {
        return $storeActionsAction($request);
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
    public function update(Action $action, UpdateActionsAction $updateActionsAction): JsonResource
    {
        return $updateActionsAction($action);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Action $action, DestroyActionsAction $destroyActionsAction): Response
    {
        return $destroyActionsAction($action);
    }
}
