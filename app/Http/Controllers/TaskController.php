<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Session;
use App\Task;



class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {

        $tasks = Task::orderBy('id', 'desc')->get(); // get to do tasks and order them by the ID
        return View('tasks.index') -> with('savedTasks', $tasks); // return view containing the list of tasks
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'taskName'=> 'required|min:5|max:255',
        ]);
        $task = new Task;
        $task->name = $request->taskName;

        $task->save();

        Session::flash('success', 'Added new task successfully!!');
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks.edit')->with('editTaskName', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->name = $request->updatedTaskName;
        $task-> save();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id); // find the task ID from the Database

        $task->delete();
        
        return redirect()->route('tasks.index'); // Once deleted stay at the index page
    }
}
