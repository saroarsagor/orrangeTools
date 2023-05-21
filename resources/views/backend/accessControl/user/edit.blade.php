@extends('backend.layouts.master')
@section('title')
    Update User
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
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">User Edit
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
                                    User Update Here...
                                </h4>
                                @can('user-edit')
                                    <a href="{{ route('users.index') }}"
                                        class="btn btn-danger font-weight-bolder float-right mb-0">
                                        <i class="la la-list"></i>Back To Record</a>
                                @endcan
                            </div>

                            <form id="jquery-val-form" method="post" action="{{ route('users.update', $user->id) }}">
                                @method("PATCH")
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label class="control-label">Name</label>
                                                <input class="form-control" name="name" type="text" value="{{ $user->name }}"
                                                    placeholder="Enter Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Email</label>
                                                <input class="form-control" name="email" type="text" value="{{ $user->email }}"
                                                    placeholder="Enter Email" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">password</label>
                                                <input class="form-control" name="password" type="password"
                                                    placeholder="Enter password">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label class="control-label">password_confirmation</label>
                                                <input class="form-control" name="password_confirmation" type="password"
                                                    placeholder="Enter password_confirmation" >
                                            </div>

                                            <div class="form-group">
                                                <label id="selectRole">Select Role</label>
                                                <select name="roles" class="form-control select2" id="selectRole" required="">
                                                    <option value="">Select Role</option>
                                                    @foreach ($roles as $result)
                                                        <option {{ $result -> name == $user->user_type ? 'selected' : '' }} value="{{ $result->name }}">{{ $result->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
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
            </section>
            <!-- Tooltip validations end -->
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="{{ url(asset('assets/js/plugins/bootstrap-datepicker.min.js')) }}'))}}">
    </script>
    <script type="text/javascript" src="{{ url(asset('assets/js/plugins/select2.min.js')) }}"></script>
    <script type="text/javascript" src="{{ url(asset('assets/js/plugins/bootstrap-datepicker.min.js')) }}"></script>
    <script type="text/javascript">
        $('#sl').on('click', function() {
            $('#tl').loadingBtn();
            $('#tb').loadingBtn({
                text: "Signing In"
            });
        });

        $('#el').on('click', function() {
            $('#tl').loadingBtnComplete();
            $('#tb').loadingBtnComplete({
                html: "Sign In"
            });
        });

        $('#demoDate').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true
        });

        $('#demoSelect').select2();
    </script>
