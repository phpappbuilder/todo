@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <!-- Current Tasks -->
            @if (count($tasks) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Tasks
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Task</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Date start</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text"><div>{{ $task->title }}</div></td>
                                        <td class="table-text"><div>{{ $task->description }}</div></td>
                                        <td class="table-text"><div>{{ config('task.status')[$task->status] }}</div></td>
                                        <td class="table-text"><div>{{ $task->date_start }}</div></td>
                                        <!-- Task Delete Button -->
                                        <td>
                                            <form action="{{ url('task/'.$task->id) }}" method="POST" class="form-inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                                <a class="btn btn-success" href="{{ url('edit/'.$task->id) }}">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </a>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
