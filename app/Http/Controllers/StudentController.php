<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Student;
use App\StudentCourses;
use Lecture;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(\Auth::check()){
            if(\Auth::user()->role_id==4){
                $student =  DB::table('students')
                            ->join('users', 'students.user_id', '=', 'users.id')
                            ->where('users.id', '=', \Auth::user()->id)->first();
                            
                $student_id = Student::where('user_id','=',\Auth::user()->id)->first()->id;
                
                $courses = DB::table('courses')
                            ->join('student_courses', 'student_courses.course_id', '=', 'courses.id')
                            ->where('student_courses.student_id', '=', $student_id)->get();
                
                $is_mainadmin =false;
                $is_professor =false;
                            
                return view('student.profile', compact('student', 'courses', 'is_mainadmin', 'is_professor'));
            }               
            else
                return redirect('/'); 
        }
        else   
            return redirect('/'); 
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if(\Auth::check()){
            if(\Auth::user()->role_id==4){
                switch($id)
                {
                    case 'settings':
                        $email=\Auth::user()->email;
                        return view('student.settings', compact('email'));
                        break;
                    default:
                        return abort(404);
                }
            }               
            else
                return redirect('/'); 
        }
        else   
            return redirect('/'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function enroll(Request $request)
    {
        $student_id = Student::where('user_id','=',\Auth::user()->id)->first()->id;
        
        $query = StudentCourses::create(['student_id'=> $student_id, 'course_id'=>$request->course_id]);
        
        return redirect('course/'.$request->course_id);
    }
}
