@extends('backend.layouts.master')
@section('title')
    Update Profile
@endsection
@section('styles')
@endsection
@section('content')

    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Profile</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Profile-Update
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <!-- users edit start -->
            <section class="app-user-edit">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills" role="tablist">
                        </ul>
                        <div class="tab-content">
                            <!-- Account Tab starts -->
                            <form id="jquery-val-form" action="{{ route('students.update', $data->id) }}" method="post"
                                enctype="multipart/form-data">
                                @method("put")
                                @csrf
                                
                                <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                    <!-- users edit media object start -->
                                    <div class="media mb-2">
                                        @if (file_exists('backend/custom/studentImage/' . $data->image))
                                        <img src="{{ asset('backend/custom/studentImage/' . $data->image) }}" alt="users avatar"
                                            class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                            height="90" width="90" />
                                    
                                        @else
                                            @if ($data->gender == 'Male')
                                                <img src="{{ asset('backend/custom/images/male.png') }}" alt="users avatar"
                                                class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                                height="90" width="90" />
                                            @else
                                                <img src="{{ asset('backend/custom/images/female.png') }}" alt="users avatar"
                                                class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
                                                height="90" width="90" />
                                            @endif
                                        @endif

                                        <div class="media-body mt-50">
                                            <h4>{{ $data->name }}</h4>
                                            <div class="col-12 d-flex mt-1 px-0">
                                                <label class="btn btn-primary mr-75 mb-0" for="change-picture">
                                                    <span class="d-none d-sm-block">Change</span>
                                                    <input class="form-control" type="file" name="image" id="change-picture" hidden
                                                        accept="image/png, image/jpeg, image/jpg" />
                                                    <span class="d-block d-sm-none">
                                                        <i class="mr-0" data-feather="edit"></i>
                                                    </span>
                                                </label>
                                                <button class="btn btn-outline-secondary d-block d-sm-none">
                                                    <i class="mr-0" data-feather="trash-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- users edit media object ends -->
                                    <!-- users edit account form start -->
                                    <form class="form-validate">
                                        <div class="row">
                                           
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" placeholder="Name"
                                                        value="{{ $data->name }}" name="name" id="name" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="phone">E-mail</label>
                                                    <input type="number" class="form-control" placeholder="Phone"
                                                        value="{{ $data->mobile }}" name="phone" id="phone" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="date_of_birth"
                                                        class="ccontrol-label">{{ __('Date of Birth') }}</label>
                                                    <input type="text" id="date_of_birth"
                                                        class="form-control flatpickr-basic" name="date_of_birth"
                                                        value="{{ $data->date_of_birth }}">
                                                    @error('date_of_birth')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="gender">Gender</label>
                                                    <select name="gender" class="form-control" id="gender" required="">
                                                      
                                                        <option {{ $data->gender == 'Male' ? 'selected':'' }}>Male</option>
                                                        <option {{ $data->gender == 'Female' ? 'selected':'' }}>Female</option>
                                                        <option {{ $data->gender == 'Other' ? 'selected':'' }} >Other</option>
                                                    </select>
                                                    <div class="valid-feedback">Looks good!</div>
                                                    <div class="invalid-feedback">Please select your gender</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="className">Class Select</label>
                                                    <select style="cursor: pointer;" name="class_id" class="form-control" id="className" required="">
                                                        <option value="">Class Name Select</option>
                                                        @foreach ($classs as $class)
                                                            <option value="{{ $class->id }}" {{ $class->id == $data->class_id ? 'selected' : '' }}>{{ $class->class_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="hiddenClassId" id="hiddenClassId">
                                                    <div class="valid-feedback">Looks good!</div>
                                                    <div class="invalid-feedback">Please select your country</div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="sectionShow">Section Select</label>
                                                    <select name="section_id" class="form-control" id="selectedSection"
                                                        required="" style="cursor: pointer;">
                                                        <option value="">Select Section Name</option>
                                                        @foreach ($sections as $section)
                                                            <option value="{{ $section->id }}" {{ $section->id == $data->section_id ? 'selected' : '' }}>{{ $section->section_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    
                                                    <select name="section_id" class="form-control" id="sectionShow"
                                                        required="" style="display: none;"> 

                                                    </select>
                                                    <div class="valid-feedback">Looks good!</div>
                                                    <div class="invalid-feedback">Please select your country</div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="guardian_name"
                                                        class="ccontrol-label">{{ __('Guardian Name') }}</label>
                                                    <input id="name" type="text" class="form-control" name="guardian_name"
                                                        value="{{ $data->guardian_name }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="guardian_mobile"
                                                        class="ccontrol-label">{{ __('Guardian Mobile') }}</label>
                                                    <input id="name" type="number" class="form-control"
                                                        name="guardian_mobile" value="{{ $data->guardian_mobile }}"
                                                        required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="gender">Payment Type</label>
                                                    <select name="student_type" class="form-control" id="student_type"
                                                        required="">
                                                        <option value="">Select Payment Type</option>
                                                        <option value="Contractual" {{ $data->student_type == 'Contractual' ? 'selected':'' }}>Contractual</option>
                                                        <option value="Monthly" {{ $data->student_type == 'Monthly' ? 'selected':'' }}>Monthly</option>
                                                    </select>
                                                    <div class="valid-feedback">Looks good!</div>
                                                    <div class="invalid-feedback">Please select your Gender</div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fees" class="ccontrol-label">{{ __('Fees') }}</label>
                                                    <input id="name" type="number" class="form-control" name="fees"
                                                        value="{{ $data->fees }}" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <textarea class="form-control" id="address" name="address" rows="3"
                                                        placeholder="Enter Address">{{ $data->address }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-12 d-flex flex-sm-row flex-column mt-2 justify-content-end">
                                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1">Save
                                                    Changes</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- users edit account form ends -->
                                </div>
                            </form>
                            <!-- Account Tab ends -->

                        </div>
                    </div>
                </div>
            </section>
            <!-- users edit ends -->
        </div>


    </div>

@endsection
