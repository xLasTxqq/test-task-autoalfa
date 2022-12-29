<?php

namespace App\Http\Controllers\Api\v1;

use App\Actions\Action\CreateActionsAction;
use App\Actions\Action\DestroyActionsAction;
use App\Actions\Action\ReadActionsAction;
use App\Actions\Action\UpdateActionsAction;
use App\Actions\UpdateActionClientAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActionRequest;
use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReadActionsAction $readActionsAction):Response
    {
        return response($readActionsAction());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreateActionsAction $createActionsAction):Response
    {
        return response($createActionsAction($request));
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
    public function update(Request $request, Action $id, UpdateActionsAction $updateActionsAction)
    {
        return response($updateActionsAction($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DestroyActionsAction $destroyActionsAction):Response
    {
        return response($destroyActionsAction($id));
    }
}
