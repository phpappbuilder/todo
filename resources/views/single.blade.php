@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                     Task
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                @include('common.errors')

                <!-- New Task Form -->
                    <form action="{{ $action }}" method="{{ $method }}" class="form-horizontal">
                    {{ csrf_field() }}

                    <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Task</label>

                            <div class="col-sm-6">
                                <input type="text" name="title" id="task-name" class="form-control" value="{{ $data['title'] }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task-description" class="col-sm-3 control-label">Description</label>

                            <div class="col-sm-6">
                                <textarea name="description" id="task-description" class="form-control">{{ $data['description'] }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task-status" class="col-sm-3 control-label">Status</label>

                            <div class="col-sm-6">
                                {{ Form::select('status', config('task.status') , $data['status']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="task-date" class="col-sm-3 control-label">Date start</label>

                            <div class="col-sm-6">
                                <input type="date" name="date_start" id="task-date" class="form-control" value="{{ $data['date_start'] }}">
                            </div>
                        </div>
                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    {{ $submit_btn }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
