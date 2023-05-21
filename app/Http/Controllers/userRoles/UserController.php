<?php

namespace App\Http\Controllers\userRoles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Student;
use App\Models\Classname;
use App\Models\Section;
use App\Models\Attendance;
use App\Models\StudentPayment;
use Carbon\Carbon;
use DB;
use Auth;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-show', ['only' => ['index','show']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->user_type == 'systemadmin'){
            $users =  User::orderBy('id', 'desc')->get();
        }
        else if(Auth::user()->user_type == 'coaching'){
            $users =  User::orderBy('id', 'desc')->where('coaching_id', Auth::user()->id)->get();
        }
        else if(Auth::user()->user_type == 'admin'){
            $users =  User::orderBy('id', 'desc')->where('coaching_id', Auth::user()->coaching_id)->where('admin_id', Auth::user()->id)->get();
        }
        
        return view('backend.accessControl.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.accessControl.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|max:100|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = new User();

        if(Auth::user()->user_type == 'systemadmin'){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->status = 1;
            $user->user_type = 'coaching';

            //coaching_no generate
            if( $user->user_type = 'coaching'){
                $new_id = User::max('id')+1;
                $admission_id = strlen($new_id);
                $admission_id = substr("000000",0,-$admission_id);
                $user->coaching_no = $admission_id.$new_id;
            }

            $user->password = bcrypt($request->password);
        }
        else if(Auth::user()->user_type == 'coaching'){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->status = 1;
            $user->user_type = 'admin';
            $user->coaching_id = Auth::user()->id;
            $user->coaching_no = Auth::user()->coaching_no;
            $user->password = bcrypt($request->password);
        }
        else if(Auth::user()->user_type == 'admin'){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->status = 1;
            $user->user_type = 'teacher';
            $user->coaching_id = Auth::user()->coaching_id;
            $user->admin_id = Auth::user()->id;
            $user->password = bcrypt($request->password);
        }
       
        // dd($user);
        if($user->save()){
            $user->syncRoles($request->get('roles'));
            Toastr::success('User Created Successfully!.', '', ["progressbar" => true]);
            return redirect()->route('users.index');
        }else{
            Toastr::error('Something is error there...!', '', ["progressbar" => true]);
            return redirect()->back();
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $data = [
            'model' => $user,
        ];
        return view('backend.users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('backend.accessControl.user.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|max:100|email|unique:users',
            'password' => 'confirmed',
        ]);

        $user = User::find($id);

        if(Auth::user()->user_type == 'systemadmin'){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->user_type = 'coaching';
            $user->password = bcrypt($request->password);
        }
        else if(Auth::user()->user_type == 'coaching'){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->user_type = 'admin';
            $user->coaching_id = Auth::user()->id;
            $user->password = bcrypt($request->password);
        }
        else if(Auth::user()->user_type == 'admin'){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->user_type = 'teacher';
            $user->coaching_id = Auth::user()->coaching_id;
            $user->admin_id = Auth::user()->id;
            $user->password = bcrypt($request->password);
        }
            
        if($user->save()){
            $user->syncRoles($request->get('roles'));
            Toastr::success('User Updated Successfully!.', '', ["progressbar" => true]);
            return redirect()->route('users.index');
        }else{
            Toastr::error('Something is error there...!', '', ["progressbar" => true]);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Toastr::success('User Deleted Successfully!.', '', ["progressbar" => true]);
        return redirect()->back();
    }




    //User-Profile Section....

    public function userProfile(Request $request, $id)
    {
        $data = Student::find($id);
        $currentYear = $data->created_at->format('Y');

        $studentPayments = StudentPayment::where('student_id', $id)->get();

        // dd($studentPayments);


        //Student-Present Count....
        $januaryPresent = Attendance::where('student_id', $id)->where('present', true)->where('month', 'January')->count();
        $februaryPresent = Attendance::where('student_id', $id)->where('present', true)->where('month', 'February')->count();
        $marchPresent = Attendance::where('student_id', $id)->where('present', true)->where('month', 'March')->count();
        $aprilPresent = Attendance::where('student_id', $id)->where('present', true)->where('month', 'April')->count();
        $mayPresent = Attendance::where('student_id', $id)->where('present', true)->where('month', 'May')->count();
        $junePresent = Attendance::where('student_id', $id)->where('present', true)->where('month', 'June')->count();
        $julyPresent = Attendance::where('student_id', $id)->where('present', true)->where('month', 'July')->count();
        $augustPresent = Attendance::where('student_id', $id)->where('present', true)->where('month', 'August')->count();
        $septemberPresent = Attendance::where('student_id', $id)->where('present', true)->where('month', 'September')->count();
        $octoberPresent = Attendance::where('student_id', $id)->where('present', true)->where('month', 'October')->count();
        $novemberPresent = Attendance::where('student_id', $id)->where('present', true)->where('month', 'November')->count();
        $decemberPresent = Attendance::where('student_id', $id)->where('present', true)->where('month', 'December')->count();
        
        //Student-Absence Count....
        $januaryAbsence = Attendance::where('student_id', $id)->where('absence', true)->where('month', 'January')->count();
        $februaryAbsence = Attendance::where('student_id', $id)->where('absence', true)->where('month', 'February')->count();
        $marchAbsence = Attendance::where('student_id', $id)->where('absence', true)->where('month', 'March')->count();
        $aprilAbsence = Attendance::where('student_id', $id)->where('absence', true)->where('month', 'April')->count();
        $mayAbsence = Attendance::where('student_id', $id)->where('absence', true)->where('month', 'May')->count();
        $juneAbsence = Attendance::where('student_id', $id)->where('absence', true)->where('month', 'June')->count();
        $julyAbsence = Attendance::where('student_id', $id)->where('absence', true)->where('month', 'July')->count();
        $augustAbsence = Attendance::where('student_id', $id)->where('absence', true)->where('month', 'August')->count();
        $septemberAbsence = Attendance::where('student_id', $id)->where('absence', true)->where('month', 'September')->count();
        $octoberAbsence = Attendance::where('student_id', $id)->where('absence', true)->where('month', 'October')->count();
        $novemberAbsence = Attendance::where('student_id', $id)->where('absence', true)->where('month', 'November')->count();
        $decemberAbsence = Attendance::where('student_id', $id)->where('absence', true)->where('month', 'December')->count();
        
        //Student-Late Count....
        $januaryLate = Attendance::where('student_id', $id)->where('late', true)->where('month', 'January')->count();
        $februaryLate = Attendance::where('student_id', $id)->where('late', true)->where('month', 'February')->count();
        $marchLate = Attendance::where('student_id', $id)->where('late', true)->where('month', 'March')->count();
        $aprilLate = Attendance::where('student_id', $id)->where('late', true)->where('month', 'April')->count();
        $mayLate = Attendance::where('student_id', $id)->where('late', true)->where('month', 'May')->count();
        $juneLate = Attendance::where('student_id', $id)->where('late', true)->where('month', 'June')->count();
        $julyLate = Attendance::where('student_id', $id)->where('late', true)->where('month', 'July')->count();
        $augustLate = Attendance::where('student_id', $id)->where('late', true)->where('month', 'August')->count();
        $septemberLate = Attendance::where('student_id', $id)->where('late', true)->where('month', 'September')->count();
        $octoberLate = Attendance::where('student_id', $id)->where('late', true)->where('month', 'October')->count();
        $novemberLate = Attendance::where('student_id', $id)->where('late', true)->where('month', 'November')->count();
        $decemberLate = Attendance::where('student_id', $id)->where('late', true)->where('month', 'December')->count();
        
        //Student-Leave Count....
        $januaryLeave = Attendance::where('student_id', $id)->where('leave', true)->where('month', 'January')->count();
        $februaryLeave = Attendance::where('student_id', $id)->where('leave', true)->where('month', 'February')->count();
        $marchLeave = Attendance::where('student_id', $id)->where('leave', true)->where('month', 'March')->count();
        $aprilLeave = Attendance::where('student_id', $id)->where('leave', true)->where('month', 'April')->count();
        $mayLeave = Attendance::where('student_id', $id)->where('leave', true)->where('month', 'May')->count();
        $juneLeave = Attendance::where('student_id', $id)->where('leave', true)->where('month', 'June')->count();
        $julyLeave = Attendance::where('student_id', $id)->where('leave', true)->where('month', 'July')->count();
        $augustLeave = Attendance::where('student_id', $id)->where('leave', true)->where('month', 'August')->count();
        $septemberLeave = Attendance::where('student_id', $id)->where('leave', true)->where('month', 'September')->count();
        $octoberLeave = Attendance::where('student_id', $id)->where('leave', true)->where('month', 'October')->count();
        $novemberLeave = Attendance::where('student_id', $id)->where('leave', true)->where('month', 'November')->count();
        $decemberLeave = Attendance::where('student_id', $id)->where('leave', true)->where('month', 'December')->count();
        




        
        //Total-Class Count....
        $januaryClass = Attendance::where('month', 'January')->where('student_id', $id)->count();
        $februaryClass = Attendance::where('month', 'February')->where('student_id', $id)->count();
        $marchClass = Attendance::where('month', 'March')->where('student_id', $id)->count();
        $aprilClass = Attendance::where('month', 'April')->where('student_id', $id)->count();
        $mayClass = Attendance::where('month', 'May')->where('student_id', $id)->count();
        $juneClass = Attendance::where('month', 'June')->where('student_id', $id)->count();
        $julyClass = Attendance::where('month', 'July')->where('student_id', $id)->count();
        $augustClass = Attendance::where('month', 'August')->where('student_id', $id)->count();
        $septemberClass = Attendance::where('month', 'September')->where('student_id', $id)->count();
        $octoberClass = Attendance::where('month', 'October')->where('student_id', $id)->count();
        $novemberClass = Attendance::where('month', 'November')->where('student_id', $id)->count();
        $decemberClass = Attendance::where('month', 'December')->where('student_id', $id)->count();
        

        return view('backend.profile.userProfile',compact(
            'data','currentYear','studentPayments','januaryPresent','februaryPresent','marchPresent','aprilPresent','mayPresent','junePresent','julyPresent','augustPresent','septemberPresent','octoberPresent','novemberPresent','decemberPresent',
            'januaryAbsence','februaryAbsence','marchAbsence','aprilAbsence','mayAbsence','juneAbsence','julyAbsence','augustAbsence','septemberAbsence','octoberAbsence','novemberAbsence','decemberAbsence',
            'januaryLate','februaryLate','marchLate','aprilLate','mayLate','juneLate','julyLate','augustLate','septemberLate','octoberLate','novemberLate','decemberLate',
            'januaryLeave','februaryLeave','marchLeave','aprilLeave','mayLeave','juneLeave','julyLeave','augustLeave','septemberLeave','octoberLeave','novemberLeave','decemberLeave',
            'januaryClass','februaryClass','marchClass','aprilClass','mayClass','juneClass','julyClass','augustClass','septemberClass','octoberClass','novemberClass','decemberClass',
        ));
    }
    
    public function userEdit(Request $request, $id)
    {
        $data = Student::find($id);
        $classs =  Classname::all();
        $sections =  Section::all();

        return view('backend.profile.userEdit', compact('data','classs','sections'));
    }
}
