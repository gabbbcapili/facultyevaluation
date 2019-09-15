@inject('request', 'Illuminate\Http\Request')
 <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="{{ action('HomeController@index') }}">
            <i class="fa fa-dashboard"></i> <span>Home</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        @if($request->user()->isStudent())
          <!-- department -->
       <li class="treeview {{ $request->segment(1) == 'list-evaluation'  ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-newspaper-o"></i> <span>Evaluations</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $request->segment(1) == 'list-evaluation' ? 'active' : '' }}"><a href="{{ action('EvaluationListController@index') }}"><i class="fa fa-list"></i>My Evaluations</a></li>
          </ul>
        </li>  
        @endif

        @if($request->user()->isAdmin())
        <!-- department -->
       <li class="treeview {{ $request->segment(1) == 'department' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-university"></i> <span>Department</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $request->segment(1) == 'department' && $request->segment(2) == '' ? 'active' : '' }}"><a href="{{ action('DepartmentController@index') }}"><i class="fa fa-list"></i>List Departments</a></li>

          </ul>
        </li>  

        <!-- Course -->
        
       <li class="treeview {{ $request->segment(1) == 'course' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-university"></i> <span>Course</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $request->segment(1) == 'course' && $request->segment(2) == '' ? 'active' : '' }}"><a href="{{ action('CourseController@index') }}"><i class="fa fa-list"></i>List Courses</a></li>
          </ul>
        </li>  

        <!-- section -->
       <li class="treeview {{ $request->segment(1) == 'section' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-university"></i> <span>Section</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $request->segment(1) == 'section' && $request->segment(2) == '' ? 'active' : '' }}"><a href="{{ action('SectionController@index') }}"><i class="fa fa-list"></i>List Sections</a></li>
          </ul>
        </li>


        <!-- subject -->
       <li class="treeview {{ $request->segment(1) == 'subject' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-book"></i> <span>Subjects</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $request->segment(1) == 'subject' && $request->segment(2) == '' ? 'active' : '' }}"><a href="{{ action('SubjectController@index') }}"><i class="fa fa-list"></i>List Subjects</a></li>
          </ul>
        </li>

        <!-- dictionary -->
       <li class="treeview {{ $request->segment(1) == 'dictionary' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-bookmark"></i> <span>Dictionary</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $request->segment(1) == 'dictionary' && $request->segment(2) == '' ? 'active' : '' }}"><a href="{{ action('DictionaryController@index') }}"><i class="fa fa-list"></i>List Dictionary</a></li>
          </ul>
        </li>
        @endif

        @if($request->user()->isEmployee())
      <!-- department -->
       <li class="treeview {{ $request->segment(1) == 'evaluation' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-newspaper-o"></i> <span>Evaluation</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $request->segment(1) == 'evaluation' && $request->segment(2) == '' ? 'active' : '' }}"><a href="{{ action('EvaluationController@index') }}"><i class="fa fa-list"></i>List Evaluations</a></li>
          </ul>
        </li>  

          <!-- student -->
        <li class="treeview {{ $request->segment(1) == 'student' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-graduation-cap"></i> <span>Student</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $request->segment(1) == 'student' && $request->segment(2) == '' ? 'active' : '' }}"><a href="{{ action('StudentController@index') }}"><i class="fa fa-list"></i> List Students </a></li>
            <li class="{{ $request->segment(1) == 'student' && $request->segment(2) == 'import' ? 'active' : '' }}"><a href="{{ action('StudentController@import') }}"><i class="fa fa-download"></i> Import Students </a></li>
          </ul>
        </li>     

          <!-- faculty -->
        <li class="treeview {{ $request->segment(1) == 'faculty' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-users"></i> <span>Employee</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $request->segment(1) == 'faculty' && $request->segment(2) == '' ? 'active' : '' }}"><a href="{{ action('FacultyController@index') }}"><i class="fa fa-list"></i> List Employees </a></li>
          </ul>
        </li>  
        @endif   
      </ul>
