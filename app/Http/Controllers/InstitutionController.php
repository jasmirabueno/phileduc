<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Institution;
use App\Professor;
use App\CourseCategory;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Validator;
use File;
use App\Course;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(\Auth::check()){
            if(\Auth::user()->role_id==2){
                $num_verified = collect(DB::table('professors')
                                        ->join('users', 'users.id', '=', 'professors.user_id')
                                        ->join('institutions','institutions.id', '=' , 'professors.inst_id')
                                        ->where('is_verified', true)->where('role_id', 3)
                                        ->get())
                                ->count();
                $num_pending = collect(DB::table('professors')
                                        ->join('users', 'users.id', '=', 'professors.user_id')
                                        ->join('institutions','institutions.id', '=' , 'professors.inst_id')
                                        ->where('is_verified', false)->where('role_id', 3)
                                        ->get())
                                ->count();
                
                $institution = DB::table('users')
                                        ->join('institutions', 'users.id', '=', 'institutions.admin_id')
                                        ->where('users.id', '=', \Auth::user()->id)->first();
                return view('inst_admin.profile', compact('num_verified' , 'num_pending', 'institution'));
            }               
            else
                return redirect('/'); 
        }
        else   
            return redirect('/'); 
        
    }


    public function show($id)
    {
        if(\Auth::check()){
            if(\Auth::user()->role_id==2){
                $is_mainadmin=false;
                $inst_id = Institution::where('admin_id', '=', \Auth::user()->id)->first()->id;
                
                $professors_verified = DB::table('professors')
                                        ->join('users', 'users.id', '=', 'professors.user_id')
                                        ->join('institutions','institutions.id', '=' , 'professors.inst_id')
                                        ->where('is_verified', true)->where('role_id', 3)
                                        ->where('professors.inst_id','=', $inst_id)
                                        ->get();
                                        
                $professors_pending = DB::table('professors')
                                        ->join('users', 'users.id', '=', 'professors.user_id')
                                        ->join('institutions','institutions.id', '=' , 'professors.inst_id')
                                        ->where('is_verified', false)->where('role_id', 3)
                                        ->where('professors.inst_id','=', $inst_id)
                                        ->get();
                                        
                $num_verified = collect($professors_verified)->count();
                $num_pending = collect($professors_pending)->count();
                switch($id)
                {
                    case 'professors-verified':
                        $is_verified=true;
                        return view('inst_admin.professor_inst', compact('is_mainadmin', 'is_verified', 'num_pending', 'num_verified', 'professors_verified'));
                        break;
                    case 'professors-pending':
                        $is_verified=false;
                        return view('inst_admin.professor_inst', compact('is_mainadmin', 'is_verified', 'num_pending', 'num_verified', 'professors_pending'));
                        break;
                    case 'courses':
                        $inst_id = Institution::where('admin_id', \Auth::user()->id)->first()->id;
                        $is_professor = false;
                        $courses = DB::table('courses')->where('inst_id', $inst_id)
                                    ->get();
                        return view('shared.courses', compact('is_mainadmin', 'is_verified', 'num_pending', 'num_verified', 'professors_pending', 'courses', 'is_professor'));
                        break;
                    case 'add_course':
                        $categories = CourseCategory::all();
                        return view('inst_admin.add_course', compact('is_mainadmin', 'num_pending', 'num_verified', 'professors_verified', 'categories'));
                    case 'category_requests':
                        return view('inst_admin.category_requests',  compact('is_mainadmin', 'is_verified', 'num_pending', 'num_verified', 'professors_pending'));
                    case 'settings':
                        $email=\Auth::user()->email;
                        $is_professor = false;
                        return view('shared.settings',compact('is_mainadmin','email', 'num_verified' , 'num_pending', 'is_professor'));
                        break;
                    case 'edit': 
                        $institution = DB::table('users')
                                        ->join('institutions', 'users.id', '=', 'institutions.admin_id')
                                        ->where('users.id', '=', \Auth::user()->id)->first();
                         return view('inst_admin.edit_profile',compact('is_mainadmin','email', 'num_verified' , 'num_pending', 'institution'));
                         break;
                    default:
                        return abort(404);
                }
            }
            else
                return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit_profile(Request $request)
    {
        if($request->logo)
        {
            $institution = Institution::where('admin_id','=', \Auth::user()->id)->first();
           
            $imageName = "inst_".$institution->id.'.'.Input::file('logo')->getClientOriginalExtension();
            Input::file('logo')->move(base_path().'/public/images/institution/', $imageName);
            
            $institution->logo = $imageName."";
            $institution->save();
            
            $institution->update(['inst_name' => $request->name, 'inst_description'=> $request->description,  'contactno'=> $request->contactno]);
            return redirect('/institution')->with('status', 'Profile Updated!');
        }
        else
        {
            Institution::where('admin_id','=', \Auth::user()->id)
                ->update(['inst_name' => $request->name, 'inst_description'=> $request->description,  'contactno'=> $request->contactno]);
            return redirect('/institution')->with('status', 'Profile Updated!');
        }
            
    }

    
    public function accept_prof(Request $request)
    {
        $user = User::where('id', $request->input('prof_id'))->first();
        $user->is_verified = true;
        $user->save();
        return redirect('institution/professors-pending');
    }
    
    public function decline_prof(Request $request)
    {
        $user = User::find($request->input('prof_id'));
        $institution = Professor::where('user_id', $user['id']);
        $user->delete();
        $institution->delete();
        return redirect('institution/professors-pending');
    }
    
    public function categ_requests(Request $request)
    {
        $category = CourseCategory::create(['categ_name'=> $request->name]);
        return redirect('institution/category_requests')->with('status', 'Category Request Submitted!');
    }
    
    public function add_course(Request $request)
    {
        $validator = $this->course_validator($request->all());
        
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }             
        $inst_id = Institution::where('admin_id', \Auth::user()->id)->first()->id;
        $categ_id = CourseCategory::where('categ_name', $request->category)->first()->id;
        
        $course = Course::create([
            'course_name'=>$request->name, 
            'course_description'=>$request->description, 
            'course_image'=> $request->image, 
            'prof_id'=>$request->professor,
            'category_id'=>$categ_id,
            'inst_id'=>$inst_id]);
            
        $imageName = "course_".$course->id.'.'.Input::file('image')->getClientOriginalExtension();
        Input::file('image')->move(base_path().'/public/images/course/', $imageName);
        
        $course->course_image = $imageName;
        $course->save();
        
        return redirect('institution/courses')->with('status', 'You have successfully added a course!');
    }
    
    protected function course_validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:courses,course_name',
            'description' => 'required|min:3',
            'image' => 'required',
            'professor'=> 'required|exists:professors,prof_id',
            'category' => 'required|exists:course_category,categ_name'           
        ]);
    }
}
