@extends('app')

@section('content')
  <!--BEGIN #signup-form -->
    <div id="signup-form">
        
        <!--BEGIN #subscribe-inner -->
        <div id="signup-inner">
        
        	<div class="clearfix" id="header" style="padding-left:150px; padding-top:150px; height:250px;">
        
                <h1 >One step to go and you'll get started!</h1>

            
            </div>
			

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form id="send" method="POST" action="{{url('register/student_profile')}}" enctype="multipart/form-data">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{$user_id}}">
                
                
                <p>
                <label for="firstname">First Name </label>
                <input id="name" type="text" name="firstname" value="" />
                </p>
				
				<p>
                <label for="lastname">Last Name </label>
                <input id="name" type="text" name="lastname" value="" />
                </p>
                
                <p>
                <label for="about">About You</label>
                <textarea name="about" id="about" cols="30" rows="10"></textarea>
                </p>
                
                
                <p>
                <label for="image">Profile Photo</label>
                <input id="image" type="file" name="image" value="" />
                </p>
                
                
                <p>

                <button id="submit" type="submit">Submit</button>
                </p>
                
            </form>
            
		<div id="required">
		<p>* Required Fields</p>
		</div>


            </div>
        
        <!--END #signup-inner -->
        </div>
        
    <!--END #signup-form -->   
    </div>
@stop