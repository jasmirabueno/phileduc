<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;
use App\CourseCategory;
use App\StudentCourses;
use App\Student;
use Lecture;
use App\Professor;
use DB;
use Input;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //display all courses
        if(\Auth::check()){
            if(\Auth::user()->role_id==4){
                $is_student = true;
            }               
            else
                $is_student = false;
        }
        else   
            $is_student = false;
        
        $categories = CourseCategory::all();
        $courses = DB::table('courses')
                    ->join('institutions', 'institutions.id', '=', 'courses.inst_id')
                    ->select('courses.*', 'institutions.inst_name')
                    ->where('courses.is_open','=', true)
                    ->get();
        return view('course.view', compact('is_student', 'categories', 'courses'));
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
        $course = Course::findOrFail($id);
        if(\Auth::user()->role_id==3)
        {
             $is_professor = true;
             $professor = DB::table('professors')
                            ->join('users', 'professors.user_id', '=', 'users.id')
                            ->where('users.id', '=', \Auth::user()->id)->first();
             $lectures = DB::table('lectures')->where('course_id','=',$id)->get();
             return view('shared.course_detail', compact('course', 'is_professor', 'professor', 'course', 'lectures'));
        }
        if(\Auth::user()->role_id==4)
        {
            
            $courses = DB::table('courses')
                    ->join('institutions', 'institutions.id', '=', 'courses.inst_id')
                    ->join('professors', 'professors.prof_id', '=', 'courses.prof_id')
                    ->where('courses.id','=', $id)
                    ->first();
            
            $student_id = Student::where('user_id','=',\Auth::user()->id)->first()->id;
            
            
            $student_course = StudentCourses::where('student_id','=', $student_id)->where('course_id','=',$id)->first();
            if($student_course){
                $is_enrolled=true;
            }
            else{
                $is_enrolled=false;
            }
            $lectures = DB::table('lectures')->where('course_id','=',$id)->get();
            $is_student = true;
            return view('course.view_one', compact('courses', 'is_student', 'is_enrolled', 'lectures'));
        }       
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        if(\Auth::user()->role_id==3)
        {
            $professor = DB::table('professors')
                            ->join('users', 'professors.user_id', '=', 'users.id')
                            ->where('users.id', '=', \Auth::user()->id)->first();
            return view('professor.edit_course', compact('course', 'professor'));
        }
       
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
        if($request->image)
        {
            $course= Course::find($id);
            
            $imageName = "c_".$id.'.'.Input::file('image')->getClientOriginalExtension();
            Input::file('image')->move(base_path().'/public/images/course/', $imageName);
            $course->course_image = $imageName;
            $course->save();
            $course->update(['course_name' => $request->name,'course_description'=> $request->description]);
            return redirect('/course/'.$id)->with('status', 'Course Updated!');
        }
        else
        {
            $course= Course::find($id);
            $course->update(['course_name' => $request->name,'course_description'=> $request->description]);
            return redirect('/course/'.$id)->with('status', 'Course Updated!');
        }
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
    
    public function open_course(Request $request)
    {
        $course = Course::findOrfail($request->course_id);
        
        $course->is_open =true;
        $course->save();
        
        return redirect('/course/'.$request->course_id)->with('opened', 'Course Opened!');
    }
}
