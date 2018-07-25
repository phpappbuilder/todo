<?php
namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view(
            'tasks', [
                'tasks' => Task::orderBy('created_at', 'asc')->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view(
            'single', [
                'action' => route('store'),
                'submit_btn' => 'Add Task',
                'method' => 'POST',
                'data' => [
                    'title' => old('title'),
                    'description' => old('description'),
                    'status' => old('status'),
                    'date_start' => old('date_start')
                ]
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(), config('task.validators')
        );

        if ($validator->fails()) {
            return redirect(route('create'))->withInput()->withErrors($validator);
        }

        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->date_start = $request->date_start;
        $task->save();

        return redirect(route('index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view(
            'single', [
                'action' => route('update', ['id'=>$id]),
                'submit_btn' => 'Save task',
                'method' => 'POST',
                'data' => [
                    'title' => $task -> title,
                    'description' => $task -> description,
                    'status' => $task -> status,
                    'date_start' => $task -> date_start
                ]
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(), config('task.validators')
        );

        if ($validator->fails()) {
            return redirect(route('update', ['id'=>$id]))
                ->withInput()
                ->withErrors($validator);
        }

        $task = Task::findOrFail($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->date_start = $request->date_start;
        $task->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();

        return redirect('/');
    }
}
