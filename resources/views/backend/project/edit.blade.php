@extends('backend.layouts.master')
@section('title')
    Edit Project
@endsection
@section('styles')
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0"> Edit Project</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('project.index') }}"> Edit Project</a>
                                </li>
                                <li class="breadcrumb-item active"> Edit Project
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
                                    Create Project
                                </h4>
                                    <a href="{{ route('project.index') }}"
                                       class="btn btn-danger font-weight-bolder float-right mb-0">
                                        <i class="la la-list"></i>Back To Record</a>
                            </div>

                            <form id="jquery-val-form" action="{{ route('project.update', $data->id) }}" method="post">
                                @method("PATCH")
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label class="control-label">Name</label>
                                                <input class="form-control" name="name" type="text" placeholder="Enter Name" value="{{ $data->name }}">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </form>
                            <!--end::Form-->
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
