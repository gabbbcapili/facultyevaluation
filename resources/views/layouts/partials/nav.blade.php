 <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="{{ action('HomeController@index') }}">
            <i class="fa fa-dashboard"></i> <span>Home</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="treeview {{ $request->segment(1) == 'users' && $request->segment(2) == '' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $request->segment(1) == 'users' && $request->segment(2) == '' ? 'active' : '' }}"><a href="{{ action('UserController@index') }}"><i class="fa fa-list"></i> List Users </a></li>
          </ul>
        </li>     

        <li class="treeview {{ $request->segment(1) == 'contacts' && $request->segment(2) == '' ? 'active' : '' }}">
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
        </li>  
      </ul>
