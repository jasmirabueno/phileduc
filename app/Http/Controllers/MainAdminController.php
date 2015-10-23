<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Institution;
use App\CourseCategory;
use DB;

use Validator;


class MainAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
     
    public function _construct(){
        $this->middleware('mainadmin');
    }
     
    public function index()
    {
        if(\Auth::check()){
            if(\Auth::user()->role_id==1){
                $num_verifiedtoday = User::where('updated_at','=', date('Y-m-d'))->where('is_verified', true)->where('role_id',2)->count();
                $num_pendingtoday = User::where('updated_at','=', Carbon::now())->where('is_verified', false)->where('role_id',2)->count();
                $num_verified = User::where('is_verified', true)->where('role_id', 2)->count();
                $num_pending = User::where('is_verified', false)->where('role_id', 2)->count();
                
                $accepted_categ = CourseCategory::where('is_accepted', true)->get();
                $pending_categ = CourseCategory::where('is_accepted', false)->get();
                $num_accepted_categ = collect($accepted_categ)->count();
                $num_pending_categ = collect($pending_categ)->count();
                return view('main_admin.index', compact('num_verified', 'num_pending','num_pendingtoday','num_verifiedtoday', 'num_accepted_categ', 'num_pending_categ'));
            }               
            else
                return redirect('/'); 
        }
        else   
            return redirect('/'); 
        
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
            if(\Auth::user()->role_id==1){
                $is_mainadmin=true;
                $institutions_verified = DB::table('users')
                                        ->join('institutions', 'users.id', '=', 'institutions.admin_id')
                                        ->where('is_verified', true)->where('role_id', 2)
                                        ->get();
                
                $institutions_pending = DB::table('users')
                                        ->join('institutions', 'users.id', '=', 'institutions.admin_id')
                                        ->where('is_verified', false)->where('role_id', 2)
                                        ->get();
                                        
                $num_verified = collect($institutions_verified)->count();
                $num_pending = collect($institutions_pending)->count();
                
                $accepted_categ = DB::table('course_category')->where('is_accepted', true)->get(); 
                $pending_categ = DB::table('course_category')->where('is_accepted', false)->get();
                
                $num_accepted_categ = collect($accepted_categ)->count();
                $num_pending_categ = collect($pending_categ)->count();
                
                switch($id)
                {
                    case 'institutions-verified':                        
                        $is_verified=true;
                        return view('main_admin.institutions', compact('is_verified','institutions_verified','num_verified','num_pending', 'num_accepted_categ', 'num_pending_categ'));
                        break;
                    case 'institutions-pending':                        
                        $is_verified=false; 
                        return view('main_admin.institutions', compact('is_verified','institutions_pending','num_verified','num_pending', 'num_accepted_categ', 'num_pending_categ'));
                        break;
                    case 'settings':
                        $email=\Auth::user()->email;
                        return view('shared.settings',compact('is_mainadmin','email','num_verified', 'num_pending', 'num_accepted_categ', 'num_pending_categ'));
                        break;
                    case 'course-categories-verified':
                        $is_verified=true;                                               
                        return view('main_admin.course_field',compact('email','num_verified', 'num_pending', 'is_verified', 'accepted_categ', 'num_accepted_categ', 'num_pending_categ'));
                        break;
                    case 'course-categories-pending':
                        $is_verified=false;
                        return view('main_admin.course_field',compact('email','num_verified', 'num_pending', 'is_verified', 'pending_categ','num_accepted_categ', 'num_pending_categ'));
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
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
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
    
    public function accept_inst(Request $request)
    {
        $user = User::where('id', $request->input('inst_id'))->first();
        $user->is_verified = true;
        $user->save();
        return redirect('main-admin/institutions-pending')->with('status', 'Institution Verified!');
    }
    
    public function decline_inst(Request $request)
    {
        $user = User::find($request->input('inst_id'));
        $institution = Institution::where('admin_id', $user['id']);
        $user->delete();
        $institution->delete();
        return redirect('main-admin/institutions-pending')->with('status', 'Institution Declined!');;
    }
    
    public function accept_categ(Request $request)
    {
        $categ = CourseCategory::where('id', $request->input('categ_id'))->first();
        $categ->is_accepted = true;
        $categ->save();
        return redirect('main-admin/course-categories-pending')->with('status', $categ->name.' Course Category Accepted!');
    }
    
    public function decline_categ(Request $request)
    {
        $categ = CourseCategory::where('id', $request->input('categ_id'))->first();
        $categ->delete();
        return redirect('main-admin/course-categories-pending')->with('status', $categ->name.' Course Category Declined!');;
    }
    
}
