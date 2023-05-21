@extends('backend.layouts.master')
@section('title')
    Update Role
@endsection
@section('styles')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Role</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Edit Role
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <!-- Tooltip validations start -->
            <section class="tooltip-validations" id="tooltip-validation">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Role Update Here...
                                </h4>
                                @can('role-edit')
                                    <a href="{{ route('roles.index') }}"
                                        class="btn btn-danger font-weight-bolder float-right mb-0">
                                        <i class="la la-list"></i>Back To Record</a>
                                @endcan
                            </div>

                            <div class="card-body">
                                <form action="{{ route('roles.update', $model) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input class="form-control" name="name" value="{{ $model->name }}"
                                                type="text" placeholder="Enter Role Name">
                                        </div>


                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <strong>Permission:</strong><br><br>
                                            <div class="row">
                                                @foreach ($permission as $value)
                                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                                        <div class="form-group">
                                                            <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                                                {{ $value->name }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </div>

                                </form>
                                <!--end::Form-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Tooltip validations end -->
        </div>
    </div>
@endsection
@section('scripts')
@endsection
