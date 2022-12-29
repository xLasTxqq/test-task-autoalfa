<?php

namespace App\Http\Controllers;

use App\Actions\Action\CreateActionsAction;
use App\Actions\Action\DestroyActionsAction;
use App\Actions\Action\ReadActionsAction;
use App\Actions\Action\UpdateActionsAction;
use App\Models\Action;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReadActionsAction $readActionsAction)
    {
        return Inertia::render('Actions', ['actions'=>$readActionsAction()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreateActionsAction $createActionsAction)
    {
        $createActionsAction($request);
        return back();
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
    public function update(Request $request, Action $id, UpdateActionsAction $updateActionsAction)
    {
        $updateActionsAction($id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DestroyActionsAction $destroyActionsAction)
    {
        $destroyActionsAction($id);
        return redirect()->route('action.index');
    }
}
