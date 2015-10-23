<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Professor;
use App\Course;
use App\Lecture;
use Validator;
use Illuminate\Support\Facades\Input;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(\Auth::check()){
            if(\Auth::user()->role_id==3){
                $professor = DB::table('professors')
                            ->join('users', 'professors.user_id', '=', 'users.id')
                            ->where('users.id', '=', \Auth::user()->id)->first();
                return view('professor.profile', compact('professor'));
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
            if(\Auth::user()->role_id==3){
                switch($id)
                {
                    case 'edit':
                        $professor = DB::table('professors')
                            ->join('users', 'professors.user_id', '=', 'users.id')
                            ->where('users.id', '=', \Auth::user()->id)->first();
                        return view('professor.edit_profile', compact('professor'));
                        break;
                    case 'settings':
                        $is_mainadmin =false;
                        $is_professor =true;
                        $professor = DB::table('professors')
                            ->join('users', 'professors.user_id', '=', 'users.id')
                            ->where('users.id', '=', \Auth::user()->id)->first();
                        $email=\Auth::user()->email;
                        return view('shared.settings', compact('is_mainadmin', 'is_professor', 'professor', 'email'));
                        break;
                    case 'assigned-courses':
                        $prof_id = DB::table('professors')->where('user_id', \Auth::user()->id)->first()->prof_id;
                        $is_mainadmin = false;
                        $is_professor = true;
                        $courses = DB::table('courses')->where('prof_id',$prof_id)->get();
                        $professor = DB::table('professors')
                            ->join('users', 'professors.user_id', '=', 'users.id')
                            ->where('users.id', '=', \Auth::user()->id)->first();
                        return view('shared.courses', compact('courses','is_mainadmin', 'is_professor', 'professor'));
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
    
    public function add_lecture($id){
        $course = Course::findOrFail($id);
        //dd($course);
        if(\Auth::user()->role_id==3)
        {
             $is_professor = true;
             $professor = DB::table('professors')
                            ->join('users', 'professors.user_id', '=', 'users.id')
                            ->where('users.id', '=', \Auth::user()->id)->first();
             return view('professor.add_lecture', compact('course', 'is_professor', 'professor'));
        }
    }
    
    public function post_add_lecture(Request $request){
        $validator = $this->lecture_validator($request->all());
        
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }       
        
         $lecture = Lecture::create([
            'lecture_name'=>$request->lecture_name, 
            'lecture_description'=>$request->lecture_description, 
            'video'=> $request->video, 
            'course_id'=>$request->course_id
         ]);
         
        $videoName = "lecture_".$lecture->id.'.'.Input::file('video')->getClientOriginalExtension();
        Input::file('video')->move(base_path().'/public/videos/lectures/', $videoName);
         
        $lecture->video = $videoName;
        $lecture->save();
        
        return redirect('course/'.$request->course_id)->with('add_lecture', 'You have successfully added a lecture!');
        }
    
    protected function lecture_validator(array $data)
    {
        return Validator::make($data, [
            'lecture_name' => 'required|max:255|unique:lectures,lecture_name',
            'lecture_description' => 'required|min:3',
            'video' => 'required'           
        ]);
    }
    
    public function edit_profile(Request $request)
    {
        if($request->image)
        {
            $professor= Professor::where('user_id','=', \Auth::user()->id)->first();
            
            $imageName = "prof_".$professor->id.'.'.Input::file('image')->getClientOriginalExtension();
            Input::file('image')->move(base_path().'/public/images/professor/', $imageName);
            
            $professor->prof_image = $imageName."";
            $professor->save();
            
            $professor->update(['firstname' => $request->firstname, 'lastname' => $request->lastname, 'description'=> $request->description, 'image'=>$imageName]);
            return redirect('/professor')->with('status', 'Profile Updated!');
        }
        else
        {
            $professor= Professor::where('user_id','=', \Auth::user()->id)->first();
            $professor->update(['firstname' => $request->firstname, 'lastname' => $request->lastname, 'description'=> $request->description]);
            return redirect('/professor')->with('status', 'Profile Updated!');
        }
    }
}
