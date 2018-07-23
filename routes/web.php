<?php
use App\Task;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get(
    '/welcome', function () {
        return view('welcome');
    }
);

/**
 * List tasks
 */
Route::get(
    '/', function () {
        return view(
            'tasks', [
            'tasks' => Task::orderBy('created_at', 'asc')->get()
            ]
        );
    }
);

/**
 * Form for add new task
 */
Route::get(
    '/add', function () {
        return view(
            'single', [
            'action' => url('task'),
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
);

/**
 * Add new task
 */
Route::post(
    '/task', function (Request $request) {
        $validator = Validator::make(
            $request->all(), [
            'title' => 'required|max:100',
            'description' => 'required|max:400',
            'status' => 'required|in:1,2,3',
            'date_start' => 'required|date'
            ]
        );

        if ($validator->fails()) {
            return redirect(url('add'))->withInput()->withErrors($validator);
        }

        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->date_start = $request->date_start;
        $task->save();

        return redirect('/');
    }
);

/**
 * Delete task
 */
Route::delete(
    '/task/{id}', function ($id) {
        Task::findOrFail($id)->delete();

        return redirect('/');
    }
);

/**
 * Render form for edit single task
 */
Route::get(
    '/edit/{id}', function ($id) {
        $task = Task::findOrFail($id);
        return view(
            'single', [
            'action' => url('edit/'.$id),
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
);

/**
 * Edit task
 */
Route::post(
    '/edit/{id}', function ($id, Request $request) {
        $validator = Validator::make(
            $request->all(), [
            'title' => 'required|max:100',
            'description' => 'required|max:400',
            'status' => 'required|in:1,2,3',
            'date_start' => 'required|date'
            ]
        );

        if ($validator->fails()) {
            return redirect(url('add/'.$id))->withInput()->withErrors($validator);
        }

        $task = Task::findOrFail($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->date_start = $request->date_start;
        $task->save();

        return redirect('/');
    }
);