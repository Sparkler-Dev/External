<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskrRequest;
use App\Http\Resources\TasksResource;
use App\Models\Task;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json([
          'tasks'=>$tasks
        ]);
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
    public function show(Task $task)
    {
        if(Auth::user()->id !== $task->user_id){
            return $this->error('', 'Your not authorized', 403);
        }
        return new TasksResource($task);
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
    public function update(Request $request, Task $task)
    {
         if(Auth::user()->id !== $task->user_id){
            return $this->error('', 'Your not authorized', 403);
        }
        $task->update($request->all());

        return new TasksResource($task);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
         if(Auth::user()->id !== $task->user_id){
            return $this->error('', 'Your not authorized', 403);
        }
        $task->delete();
        return response(null, 204);
    }
}
