<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Tasks::orderBy('completed_at', 'ASC')->orderBy('created_at', 'DESC')->get();

        return response($tasks, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Tasks();
        $task->title = $request->task['title'];
        $task->save();

        return response($task, 201);
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
        $task = Tasks::find($id);
        if ($task) {
            $task->completed = $request->task['completed'] ? true : false;
            $task->completed_at = $request->task['completed'] ? Carbon::now() : null;
            $task->save();
            return response($task, 200);
        }
        return response('Task not found.', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Tasks::find($id);
        if ($task) {
            $task->delete();
            return response('The task was successfully deleted.', 200);
        }
        return response('Task not found.', 404);
    }
}
