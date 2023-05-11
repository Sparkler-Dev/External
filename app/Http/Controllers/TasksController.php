<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskrRequest;
use App\Http\Resources\TasksResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TasksResource::collection(
            Task::where('user_id', Auth::user()->id)->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskrRequest $request)
    {
        $request->validated($request->all());

        $task = Task::create([
          'user_id'=> Auth::user()->id,
          'name'=>$request->name,
          'description'=>$request->description,
          'priority'=>$request->priority,
        ]);

        return new TasksResource($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
