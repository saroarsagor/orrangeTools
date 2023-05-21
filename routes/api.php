<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Auth Controller
use App\Http\Controllers\Api\AuthController;

//User & Role Controller
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;

//Class & Section Controller
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\SectionController;

//Subject & Exam Controller
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\ExamController;

//Student & Teacher Controller
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherConroller;

//Attendance & AttendanceSearch Controller
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AttendanceSearchController;

//Student & Teacher Payment Controller
use App\Http\Controllers\Api\StudentPaymentController;
use App\Http\Controllers\Api\TeacherPaymentController;

//Student List View Controller
use App\Http\Controllers\Api\StudentListViewController;

//Student Search Controller
use App\Http\Controllers\Api\StudentSearchController;

//Student Payment Peport Controller
use App\Http\Controllers\Api\StudentPaymentPeportController;

//Result Controller
use App\Http\Controllers\Api\ResultController;

//Student Attendance History ...
use App\Http\Controllers\Api\AttendanceHistoryController;

//Student Attendance History ...
use App\Http\Controllers\Api\AllCoachingController;

//Admission Controller ...
use App\Http\Controllers\Api\AdmissionController;

//Student Transaction Controller ...
use App\Http\Controllers\Api\StudentTransactionController;

//Number Verify Controller ...
use App\Http\Controllers\Api\NumberVerifyController;

//CoachingProfileController ...
use App\Http\Controllers\Api\CoachingProfileController;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {

    /*otp verify*/
    Route::get('otp-verify', [NumberVerifyController::class, 'index'])->name('otp-verify');
    Route::post('otp-verify-code', [NumberVerifyController::class, 'verifyOtp'])->name('otp-verify-code');
    Route::get('resend-otp/{id}', [NumberVerifyController::class, 'resendOtp'])->name('resend-otp');

	//Auth Controller register login
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('login',function(){
        return response()->json(['success' => false, 'errors' => 'Unauthorized'], 401);
    })->name('login');

    Route::middleware('auth:api')->group(function () {

        //Users & Roles Controller...
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);

        //Coaching-Profile Controller...
        Route::resource('coaching-profile', CoachingProfileController::class);
        Route::post('profile/general/{id}', [CoachingProfileController::class, 'userGeneralUpdate'])->name('profile.genaral');
        Route::post('profile/password/{id}', [CoachingProfileController::class, 'userPasswordUpdate'])->name('profile.password');

    	//Class & Section Controller
        Route::resource('class', ClassController::class);
        Route::resource('section', SectionController::class);

        //Subject & Exam Controller
        Route::resource('subject', SubjectController::class);
        Route::resource('exam', ExamController::class);
        Route::post('student/create/all_subject', [ExamController::class, 'allSubject'])->name('exam.all_subject');

       // Student & Teacher Controller
        Route::resource('students', StudentController::class);
        Route::post('student/create/class_section', [StudentController::class, 'classSectionShow'])->name('student.class_section');
        Route::resource('teacher', TeacherConroller::class);

         //Attendance Controller
        Route::resource('attendance', AttendanceController::class);
        Route::post('attendance-student-search', [AttendanceController::class, 'AttendanceStudentSearch'])->name('attendance-student-search');

        //Attendance Search Controller
        /*Route::resource('student/attendance-search', AttendanceSearchController::class);*/
        Route::get('attendance-search', [AttendanceSearchController::class, 'create'])->name('attendance-search');

        //Student List View Controller
        Route::resource('student-list-view', StudentListViewController::class);
        Route::get('student-list-view.create', [AttendanceController::class, 'create'])->name('student-list-view.create');

        //Student & Teacher Payment Controller
        Route::resource('student-payment', StudentPaymentController::class);
        Route::resource('teacher-payment', TeacherPaymentController::class);

        // sagor
        //UserController
        Route::get('user-profile/{id}/', [UserController::class, 'userProfile'])->name('user-profile');
        Route::get('user-edit/{id}/', [UserController::class, 'userEdit'])->name('user-edit');

        //StudentSearchController
        Route::resource('student-searches', StudentSearchController::class);
        Route::get('student-search-profile', [StudentSearchController::class, 'StudentSearchProfile'])->name('student-search-profile');

         //Student Payment Peport Controller
        Route::resource('student-payment-report', StudentPaymentPeportController::class);
        Route::get('student-payment-details', [StudentPaymentPeportController::class, 'StudentPaymentDetails'])->name('student-payment-details');

        //Result Controller...
        Route::resource('results', ResultController::class);
        Route::get('result/student/show', [ResultController::class, 'resultShow'])->name('results.student.show');
        Route::post('results/student/all_student', [ResultController::class, 'allStudents'])->name('results.all_students');
        
        //Student Attendance History ...
        Route::get('dashboard/student-attendance-history/{id}/{currentYear}/{date}', [AttendanceHistoryController::class, 'AttendanceHistory'])->name('student-attendance-history');

         //AllCoaching Controller
         Route::get('all-coaching', [AllCoachingController::class, 'index'])->name('all-coaching.index');
         Route::get('coaching-status/{id}', [AllCoachingController::class, 'CoachingStatus'])->name('coaching-status');

        //Student Transaction Controller
        Route::resource('student-transaction', StudentTransactionController::class);
        Route::get('student-all-pay-show/{id}', [StudentTransactionController::class, 'StudentAllPayShow'])->name('student-all-pay-show');
        Route::get('student-pay-invoice/{id}', [StudentTransactionController::class, 'StudentPayInvoice'])->name('student-pay-invoice');
    
        //Coaching Admission Controller....
        Route::resource('admission', AdmissionController::class);
        Route::get('get-admission-forms', [AdmissionController::class, 'admissionForm'])->name('get-admission-forms');
        Route::get('get-admission-forms/active/{id}', [AdmissionController::class, 'admissionFormActive'])->name('get-admission.active');
        Route::get('get-admission-forms/inactive/{id}', [AdmissionController::class, 'admissionFormInactive'])->name('get-admission.inactive');
        Route::post('get-admission-forms/delete/{id}', [AdmissionController::class, 'admissionFormDelete'])->name('get-admission.delete');

        //Auth Controller logout
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });
});

