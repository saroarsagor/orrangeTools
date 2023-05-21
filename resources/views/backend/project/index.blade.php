@extends('backend.layouts.master')
@section('title')
    Project List
@endsection
@section('styles')
@endsection
@section('content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Project List</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Project List</a>
                                </li>
                                <li class="breadcrumb-item active">Project List
                                </li>
                            </ol>
                        </div>
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
                                Project List
                            </h4>
                            <a href="{{ route('project.create') }}"
                               class="btn btn-primary font-weight-bolder float-right mb-0">
                                <i class="la la-list"></i>Create Project</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped text-center table-bordered dt-responsive nowrap"
                                       style="100%">
                                    <thead>
                                    <tr>
                                        <th width="10%">SL</th>
                                        <th>Name</th>
                                        <th>Task List</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @foreach ($projects as $row)
                                        <tr style="background-color: #F5F5F5; text-align: center;">
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>
                                                <a class=""
                                                   href="{{ route('task-list',$row->id) }}">
                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                    <span>Task List</span>
                                                </a>
                                            </td>
                                            <td>

                                                <a class="btn btn-sm btn-info"
                                                   href="{{ route('project.edit', $row->id) }}">

                                                    <span>Edit</span>
                                                </a>

                                                <form method="POST"
                                                      action="{{ route('project.destroy', $row->id) }}"
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
@endsection
@section('scripts')
@endsection
