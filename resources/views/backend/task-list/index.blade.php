@extends('backend.layouts.master')
@section('title')
    Task List
@endsection
@section('styles')
@endsection
@section('content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Task List</h2>

                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Task List
                            </h4>
                            {{--<a href="{{ route('project.create') }}"
                               class="btn btn-primary font-weight-bolder float-right mb-0">
                                <i class="la la-list"></i>Create Project</a>--}}
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                               Create Task List
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped text-center table-bordered dt-responsive nowrap"
                                       style="100%">
                                    <thead>
                                    <tr>
                                        <th width="10%">SL</th>
                                        <th>Project Name</th>
                                        <th>Task Name</th>
                                        <th>Task Details</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($taskLists as $row)
                                        <tr style="background-color: #F5F5F5; text-align: center;">
                                            <td>1</td>
                                            <td>{{$row->project->name}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->details}}</td>
                                            <td>{{$row->start_time}}</td>
                                            <td>{{$row->end_time}}</td>

                                            <td>

                                                <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit-{{$row->id}}"
                                                   href="{{ route('project.edit', $row->id) }}">

                                                    <span>Edit</span>
                                                </a>

                                                <form method="POST"
                                                      action="{{ route('task-list.destroy', $row->id) }}"
                                                      class="d-inline">
                                                    @csrf
                                                    @method('delete')

                                                    <button type="submit"
                                                            class=" btn btn-sm btn-danger">
                                                        <span>Delete</span>
                                                    </button>

                                                </form>

                                            </td>
                                        </tr>

                                        <div class="modal fade" id="edit-{{$row->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Task List</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form id="jquery-val-form" action="{{ route('task-list.update', $row->id) }}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" class="form-control" name="project_id" value="{{$project->id}}">

                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Name:</label>
                                                                <input type="text" class="form-control" name="name" value="{{$row->name}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Details:</label>
                                                                <textarea class="form-control" name="details">{{$row->details}}</textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Start Time:</label>
                                                                <input type="time" class="form-control" name="start_time" value="{{$row->start_time}}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">End Time:</label>
                                                                <input type="time" class="form-control" name="end_time"  value="{{$row->end_time}}">
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Responsive tables end -->
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Task List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="jquery-val-form" action="{{ route('task-list.store') }}" method="post">
                    @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="project_id" value="{{$project->id}}">

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Details:</label>
                            <textarea class="form-control" name="details"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Start Time:</label>
                            <input type="time" class="form-control" name="start_time">
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">End Time:</label>
                            <input type="time" class="form-control" name="end_time">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div
@endsection
@section('scripts')
@endsection
