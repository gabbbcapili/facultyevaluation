 <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="{{ action('HomeController@index') }}">
            <i class="fa fa-dashboard"></i> <span>Home</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>


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
            <i class="fa fa-users"></i> <span>Faculty</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $request->segment(1) == 'faculty' && $request->segment(2) == '' ? 'active' : '' }}"><a href="{{ action('FacultyController@index') }}"><i class="fa fa-list"></i> List Faculties </a></li>
          </ul>
        </li>     

    <!--     <li class="treeview {{ $request->segment(1) == 'contacts' && $request->segment(2) == '' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-users"></i> <span>Contact</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $request->segment(1) == 'contacts' && $request->segment(2) == '' ? 'active' : '' }}"><a href="{{ action('ContactController@index') }}"><i class="fa fa-list"></i> List Contacts </a></li>
          </ul>
        </li>     
        <li class="treeview {{ $request->segment(1) == 'sms' && $request->segment(2) == '' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-envelope"></i> <span>SMS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $request->segment(1) == 'sms' && $request->segment(2) == '' ? 'active' : '' }}"><a href="{{ action('SmsController@index') }}"><i class="fa fa-list"></i> Send Sms </a></li>
          </ul>
        </li>   -->
      </ul>
