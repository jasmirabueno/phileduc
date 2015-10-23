<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{url('main_admin')}}">PhilEd</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{$professor->prof_firstname." ".$professor->prof_lastname}} <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{url('professor/settings')}}"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{url('logout')}}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li id="dashboard">
                <a href="{{url('professor')}}"><i class="fa fa-fw fa-dashboard"></i> Professor Profile</a>
            </li>
            
            <li id="courses">
                <a href="{{url('professor/assigned-courses')}}"><i class="fa fa-fw fa-list-ul"></i>  Courses Assigned</a>
            </li>                           
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>