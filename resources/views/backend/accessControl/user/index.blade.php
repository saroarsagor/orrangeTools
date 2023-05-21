@extends('backend.layouts.master')
@section('title')
    All Users
@endsection
@section('styles')
@endsection
@section('content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">User</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Home</a>
                                </li>
                                <li class="breadcrumb-item active">User List
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
                                All Users List Here...
                            </h4>
                            <a href="{{ route('users.create') }}"
                                class="btn btn-primary font-weight-bolder float-right mb-0">
                                <i class="la la-list"></i>Create User</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped text-center table-bordered dt-responsive nowrap"
                                    style="100%">
                                    <thead>
                                        <tr>
                                            <th width="10%">#</th>
                                            <th>Name</th>
                                            <th>User Id/Email</th>
                                            <th>Role</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($users as $row)
                                            <tr style="background-color: #F5F5F5; text-align: center;">
                                                <td>{{ $row->id }}</td>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->email }}</td>
                                                <td>
                                                    @if ($row->getRoleNames()->isNotEmpty())
                                                        <span class="badge badge-success">
                                                            {{ $row->getRoleNames()->implode(' ') }}<br>
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>

                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow"
                                                            data-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('users.edit', $row->id) }}">
                                                                <i data-feather="edit-2" class="mr-50"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                            <form method="POST"
                                                                action="{{ route('users.destroy', $row->id) }}"
                                                                class="d-inline">
                                                                @csrf
                                                                @method('delete')

                                                                <button type="submit"
                                                                    class=" bg-transparent border-0 dropdown-item w-100 delete-confirm">
                                                                    <i data-feather="trash" class="mr-50"></i>
                                                                    <span>Delete</span>
                                                                </button>

                                                            </form>
                                                        </div>
                                                    </div>
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
