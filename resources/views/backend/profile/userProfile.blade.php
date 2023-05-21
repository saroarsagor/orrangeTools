@extends('backend.layouts.master')
@section('title')
    User Profile
@endsection
@section('styles')
    <style>
        .user-profile-images {
            height: 170px;
            width: 160px;
        }

        .payment-success{
            background-color: rgb(0 101 167 / 70%);
            padding: 3px 14px;
            color: #ffffff;
            min-width: 70px;
        }
        
        .payment-danger{
            background-color: #ff0000a6;
            padding: 3px 5px;
            color: #ffffff;
        }

    </style>
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
                                <li class="breadcrumb-item active">User-Profile
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <section class="app-user-view">
                <!-- User Card & Plan Starts -->
                <div class="row">
                    <!-- User Card starts-->
                    <div class="col-12">
                        <div class="card user-card">
                            <div class="card-body">
                                <div class="row">
                                    <div
                                        class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 d-flex flex-column justify-content-between border-container-lg">
                                        <div class="user-avatar-section">
                                            <div class="d-flex justify-content-start">
                                                @if (file_exists('backend/custom/studentImage/' . $data->image))
                                                    <img class="img-fluid user-profile-images rounded"
                                                        src="{{ asset('backend/custom/studentImage/' . $data->image) }}"
                                                        height="90" widtd="80" alt="User avatar" />
                                                @else
                                                    @if ($data->gender == 'Male')
                                                        <img class="img-fluid user-profile-images rounded"
                                                            src="{{ asset('backend/custom/images/male.png') }}"
                                                            height="104" widtd="104" alt="User avatar" />
                                                    @else
                                                        <img class="img-fluid user-profile-images rounded"
                                                            src="{{ asset('backend/custom/images/male.png') }}"
                                                            height="104" widtd="104" alt="User avatar" />
                                                    @endif
                                                @endif
                                                <div class="d-flex flex-column ml-1">
                                                    <div class="user-info mb-1">
                                                        <h4 class="mb-0">{{ $data->name }}</h4>
                                                        <span class="card-text">Phone: {{ $data->mobile }}</span><br>
                                                        <span class="card-text">Gender: {{ $data->gender }}</span>
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        <a href="{{ route('user-edit', $data->id) }}"
                                                            class="btn btn-primary">Edit</a>

                                                        <form method="POST"
                                                            action="{{ route('students.destroy', $data->id) }}"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                class="btn btn-outline-danger ml-1 delete-confirm">
                                                                <i class="fa fa-lg fa-trash"></i>Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 mt-5 mt-xl-0 mt-lg-0 mt-md-0">
                                        <div class="user-info-wrapper">

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="d-flex flex-wrap">
                                                        <div class="user-info-title">
                                                            <i data-featder="user" class="mr-1"></i>
                                                            <span
                                                                class="card-text user-info-title font-weight-bold mb-0">Class:
                                                            </span>
                                                        </div>
                                                        <p class="card-text mb-0 ml-1"> {{ $data->className->class_name }}
                                                        </p>
                                                    </div>
                                                    <div class="d-flex flex-wrap my-50">
                                                        <div class="user-info-title">
                                                            <i data-featder="check" class="mr-1"></i>
                                                            <span
                                                                class="card-text user-info-title font-weight-bold mb-0">Section:
                                                            </span>
                                                        </div>
                                                        <p class="card-text mb-0 ml-1"> {{ $data->section->section_name }}
                                                        </p>
                                                    </div>
                                                    <div class="d-flex flex-wrap my-50">
                                                        <div class="user-info-title">
                                                            <i data-featder="check" class="mr-1"></i>
                                                            <span
                                                                class="card-text user-info-title font-weight-bold mb-0">Fees:
                                                            </span>
                                                        </div>
                                                        <p class="card-text mb-0 ml-1"> {{ $data->fees }}
                                                        </p>
                                                    </div>
                                                    <div class="d-flex flex-wrap my-50">
                                                        <div class="user-info-title">
                                                            <i data-featder="star" class="mr-1"></i>
                                                            <span
                                                                class="card-text user-info-title font-weight-bold mb-0">Birth:
                                                            </span>
                                                        </div>
                                                        <p class="card-text mb-0 ml-1">{{ $data->date_of_birth }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="d-flex flex-wrap my-50">
                                                        <div class="user-info-title">
                                                            <i data-featder="flag" class="mr-1"></i>
                                                            <span
                                                                class="card-text user-info-title font-weight-bold mb-0">Gurdian:
                                                            </span>
                                                        </div>
                                                        <p class="card-text mb-0 ml-1">{{ $data->guardian_name }}</p>
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        <div class="user-info-title">
                                                            <i data-featder="phone" class="mr-1"></i>
                                                            <span
                                                                class="card-text user-info-title font-weight-bold mb-0">Gurdian-Contact</span>
                                                        </div>
                                                        <p class="card-text mb-0 ml-1">{{ $data->guardian_mobile }}</p>
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        <div class="user-info-title">
                                                            <i data-featder="phone" class="mr-1"></i>
                                                            <span
                                                                class="card-text user-info-title font-weight-bold mb-0">Address:
                                                            </span>
                                                        </div>
                                                        <p class="card-text mb-0 ml-1">{{ $data->address }}</p>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /User Card Ends-->
                </div>
                <!-- User Card & Plan Ends -->

            </section>

            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class=" card-title">Academic histtory of {{ $data->name }}...</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap" style="100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Months</th>
                                            <th>Total Classes</th>
                                            <th>Presents</th>
                                            <th>Absence</th>
                                            <th>Late</th>
                                            <th>Leave</th>
                                            <th>PaymentType</th>
                                            <th>Fees</th>
                                            <th>PaymentStatus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>{{ $data->name }}</th>
                                            <td>
                                                @php
                                                    $date = 'January';
                                                @endphp
                                                <a
                                                    href="{{ url('dashboard/student-attendance-history/' . $data->id . '/' . $currentYear . '/' . $date) }}">January</a>
                                            </td>
                                            <td>{{ $januaryClass }}</td>
                                            <td>{{ $januaryPresent }}</td>
                                            <td>{{ $januaryAbsence }}</td>
                                            <td>{{ $januaryLate }}</td>
                                            <td>{{ $januaryLeave }}</td>
                                            <td>{{ $data->student_type }}</td>
                                            <td>{{ $data->fees }}</td>
                                            <td>
                                                @php
                                                    $studentId = $data->id;
                                                    $januaryPayment = App\Models\StudentPayment::januaryPayment($studentId, $date, $currentYear);
                                                @endphp

                                                @if (isset($januaryPayment))
                                                    @if ($januaryPayment->month == $date)
                                                        <span class=" payment-success ">Paid</span>
                                                    @endif
                                                @else
                                                    <span class=" payment-danger ">Unpaid</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ $data->name }}</th>
                                            <td>
                                                @php
                                                    $date = 'February';
                                                @endphp
                                                <a
                                                    href="{{ url('dashboard/student-attendance-history/' . $data->id . '/' . $currentYear . '/' . $date) }}">February</a>
                                            </td>
                                            <td>{{ $februaryClass }}</td>
                                            <td>{{ $februaryPresent }}</td>
                                            <td>{{ $februaryAbsence }}</td>
                                            <td>{{ $februaryLate }}</td>
                                            <td>{{ $februaryLeave }}</td>
                                            <td>{{ $data->student_type }}</td>
                                            <td>{{ $data->fees }}</td>
                                            <td>
                                                @php
                                                    $studentId = $data->id;
                                                    $februaryPayment = App\Models\StudentPayment::februaryPayment($studentId, $date, $currentYear);
                                                @endphp

                                                @if (isset($februaryPayment))
                                                    @if ($februaryPayment->month == $date)
                                                        <span class=" payment-success ">Paid</span>
                                                    @endif
                                                @else
                                                    <span class=" payment-danger ">Unpaid</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ $data->name }}</th>
                                            <td>
                                                @php
                                                    $date = 'March';
                                                @endphp
                                                <a
                                                    href="{{ url('dashboard/student-attendance-history/' . $data->id . '/' . $currentYear . '/' . $date) }}">March</a>
                                            </td>
                                            <td>{{ $marchClass }}</td>
                                            <td>{{ $marchPresent }}</td>
                                            <td>{{ $marchAbsence }}</td>
                                            <td>{{ $marchLate }}</td>
                                            <td>{{ $marchLeave }}</td>
                                            <td>{{ $data->student_type }}</td>
                                            <td>{{ $data->fees }}</td>
                                            <td>
                                                @php
                                                    $studentId = $data->id;
                                                    $marchPayment = App\Models\StudentPayment::marchPayment($studentId, $date, $currentYear);
                                                @endphp

                                                @if (isset($marchPayment))
                                                    @if ($marchPayment->month == $date)
                                                        <span class=" payment-success ">Paid</span>
                                                    @endif
                                                @else
                                                    <span class=" payment-danger ">Unpaid</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ $data->name }}</th>
                                            <td>
                                                @php
                                                    $date = 'April';
                                                @endphp
                                                <a
                                                    href="{{ url('dashboard/student-attendance-history/' . $data->id . '/' . $currentYear . '/' . $date) }}">April</a>
                                            </td>
                                            <td>{{ $aprilClass }}</td>
                                            <td>{{ $aprilPresent }}</td>
                                            <td>{{ $aprilAbsence }}</td>
                                            <td>{{ $aprilLate }}</td>
                                            <td>{{ $aprilLeave }}</td>
                                            <td>{{ $data->student_type }}</td>
                                            <td>{{ $data->fees }}</td>
                                            <td>
                                                @php
                                                    $studentId = $data->id;
                                                    $aprilPayment = App\Models\StudentPayment::aprilPayment($studentId, $date, $currentYear);
                                                @endphp

                                                @if (isset($aprilPayment))
                                                    @if ($aprilPayment->month == $date)
                                                        <span class=" payment-success ">Paid</span>
                                                    @endif
                                                @else
                                                    <span class=" payment-danger ">Unpaid</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ $data->name }}</th>
                                            <td>
                                                @php
                                                    $date = 'May';
                                                @endphp
                                                <a
                                                    href="{{ url('dashboard/student-attendance-history/' . $data->id . '/' . $currentYear . '/' . $date) }}">May</a>
                                            </td>
                                            <td>{{ $mayClass }}</td>
                                            <td>{{ $mayPresent }}</td>
                                            <td>{{ $mayAbsence }}</td>
                                            <td>{{ $mayLate }}</td>
                                            <td>{{ $mayLeave }}</td>
                                            <td>{{ $data->student_type }}</td>
                                            <td>{{ $data->fees }}</td>
                                            <td>
                                                @php
                                                    $studentId = $data->id;
                                                    $mayPayment = App\Models\StudentPayment::mayPayment($studentId, $date, $currentYear);
                                                @endphp

                                                @if (isset($mayPayment))
                                                    @if ($mayPayment->month == $date)
                                                        <span class=" payment-success ">Paid</span>
                                                    @endif
                                                @else
                                                    <span class=" payment-danger ">Unpaid</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ $data->name }}</th>
                                            <td>
                                                @php
                                                    $date = 'June';
                                                @endphp
                                                <a
                                                    href="{{ url('dashboard/student-attendance-history/' . $data->id . '/' . $currentYear . '/' . $date) }}">June</a>
                                            </td>
                                            <td>{{ $juneClass }}</td>
                                            <td>{{ $junePresent }}</td>
                                            <td>{{ $juneAbsence }}</td>
                                            <td>{{ $juneLate }}</td>
                                            <td>{{ $juneLeave }}</td>
                                            <td>{{ $data->student_type }}</td>
                                            <td>{{ $data->fees }}</td>
                                            <td>
                                                @php
                                                    $studentId = $data->id;
                                                    $junePayment = App\Models\StudentPayment::junePayment($studentId, $date, $currentYear);
                                                @endphp

                                                @if (isset($junePayment))
                                                    @if ($junePayment->month == $date)
                                                        <span class=" payment-success ">Paid</span>
                                                    @endif
                                                @else
                                                    <span class=" payment-danger ">Unpaid</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ $data->name }}</th>
                                            <td>
                                                @php
                                                    $date = 'July';
                                                @endphp
                                                <a
                                                    href="{{ url('dashboard/student-attendance-history/' . $data->id . '/' . $currentYear . '/' . $date) }}">July</a>
                                            </td>
                                            <td>{{ $julyClass }}</td>
                                            <td>{{ $julyPresent }}</td>
                                            <td>{{ $julyAbsence }}</td>
                                            <td>{{ $julyLate }}</td>
                                            <td>{{ $julyLeave }}</td>
                                            <td>{{ $data->student_type }}</td>
                                            <td>{{ $data->fees }}</td>
                                            <td>
                                                @php
                                                    $studentId = $data->id;
                                                    $julyPayment = App\Models\StudentPayment::julyPayment($studentId, $date, $currentYear);
                                                @endphp

                                                @if (isset($julyPayment))
                                                    @if ($julyPayment->month == $date)
                                                        <span class=" payment-success ">Paid</span>
                                                    @endif
                                                @else
                                                    <span class=" payment-danger ">Unpaid</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ $data->name }}</th>
                                            <td>
                                                @php
                                                    $date = 'August';
                                                @endphp
                                                <a
                                                    href="{{ url('dashboard/student-attendance-history/' . $data->id . '/' . $currentYear . '/' . $date) }}">August</a>
                                            </td>
                                            <td>{{ $augustClass }}</td>
                                            <td>{{ $augustPresent }}</td>
                                            <td>{{ $augustAbsence }}</td>
                                            <td>{{ $augustLate }}</td>
                                            <td>{{ $augustLeave }}</td>
                                            <td>{{ $data->student_type }}</td>
                                            <td>{{ $data->fees }}</td>
                                            <td>
                                                @php
                                                    $studentId = $data->id;
                                                    $augustPayment = App\Models\StudentPayment::augustPayment($studentId, $date, $currentYear);
                                                @endphp

                                                @if (isset($augustPayment))
                                                    @if ($augustPayment->month == $date)
                                                        <span class=" payment-success ">Paid</span>
                                                    @endif
                                                @else
                                                    <span class=" payment-danger ">Unpaid</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ $data->name }}</th>
                                            <td>
                                                @php
                                                    $date = 'September';
                                                @endphp
                                                <a
                                                    href="{{ url('dashboard/student-attendance-history/' . $data->id . '/' . $currentYear . '/' . $date) }}">September</a>
                                            </td>
                                            <td>{{ $septemberClass }}</td>
                                            <td>{{ $septemberPresent }}</td>
                                            <td>{{ $septemberAbsence }}</td>
                                            <td>{{ $septemberLate }}</td>
                                            <td>{{ $septemberLeave }}</td>
                                            <td>{{ $data->student_type }}</td>
                                            <td>{{ $data->fees }}</td>
                                            <td>
                                                @php
                                                    $studentId = $data->id;
                                                    $septemberPayment = App\Models\StudentPayment::septemberPayment($studentId, $date, $currentYear);
                                                @endphp

                                                @if (isset($septemberPayment))
                                                    @if ($septemberPayment->month == $date)
                                                        <span class=" payment-success ">Paid</span>
                                                    @endif
                                                @else
                                                    <span class=" payment-danger ">Unpaid</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ $data->name }}</th>
                                            <td>
                                                @php
                                                    $date = 'October';
                                                @endphp
                                                <a
                                                    href="{{ url('dashboard/student-attendance-history/' . $data->id . '/' . $currentYear . '/' . $date) }}">October</a>
                                            </td>
                                            <td>{{ $octoberClass }}</td>
                                            <td>{{ $octoberPresent }}</td>
                                            <td>{{ $octoberAbsence }}</td>
                                            <td>{{ $octoberLate }}</td>
                                            <td>{{ $octoberLeave }}</td>
                                            <td>{{ $data->student_type }}</td>
                                            <td>{{ $data->fees }}</td>
                                            <td>
                                                @php
                                                    $studentId = $data->id;
                                                    $octoberPayment = App\Models\StudentPayment::octoberPayment($studentId, $date, $currentYear);
                                                @endphp

                                                @if (isset($octoberPayment))
                                                    @if ($octoberPayment->month == $date)
                                                        <span class=" payment-success ">Paid</span>
                                                    @endif
                                                @else
                                                    <span class=" payment-danger ">Unpaid</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ $data->name }}</th>
                                            <td>
                                                @php
                                                    $date = 'November';
                                                @endphp
                                                <a
                                                    href="{{ url('dashboard/student-attendance-history/' . $data->id . '/' . $currentYear . '/' . $date) }}">November</a>
                                            </td>
                                            <td>{{ $novemberClass }}</td>
                                            <td>{{ $novemberPresent }}</td>
                                            <td>{{ $novemberAbsence }}</td>
                                            <td>{{ $novemberLate }}</td>
                                            <td>{{ $novemberLeave }}</td>
                                            <td>{{ $data->student_type }}</td>
                                            <td>{{ $data->fees }}</td>
                                            <td>
                                                @php
                                                    $studentId = $data->id;
                                                    $novemberPayment = App\Models\StudentPayment::novemberPayment($studentId, $date, $currentYear);
                                                @endphp

                                                @if (isset($novemberPayment))
                                                    @if ($novemberPayment->month == $date)
                                                        <span class=" payment-success ">Paid</span>
                                                    @endif
                                                @else
                                                    <span class=" payment-danger ">Unpaid</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ $data->name }}</th>
                                            <td>
                                                @php
                                                    $date = 'December';
                                                @endphp
                                                <a
                                                    href="{{ url('dashboard/student-attendance-history/' . $data->id . '/' . $currentYear . '/' . $date) }}">December</a>
                                            </td>
                                            <td>{{ $decemberClass }}</td>
                                            <td>{{ $decemberPresent }}</td>
                                            <td>{{ $decemberAbsence }}</td>
                                            <td>{{ $decemberLate }}</td>
                                            <td>{{ $decemberLeave }}</td>
                                            <td>{{ $data->student_type }}</td>
                                            <td>{{ $data->fees }}</td>
                                            <td>
                                                @php
                                                    $studentId = $data->id;
                                                    $decemberPayment = App\Models\StudentPayment::decemberPayment($studentId, $date, $currentYear);
                                                @endphp

                                                @if (isset($decemberPayment))
                                                    @if ($decemberPayment->month == $date)
                                                        <span class=" payment-success ">Paid</span>
                                                    @endif
                                                @else
                                                    <span class=" payment-danger ">Unpaid</span>
                                                @endif
                                            </td>
                                        </tr>
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
