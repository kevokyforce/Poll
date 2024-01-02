<div class="sidebar" data-color="blue">
      
  <div class="logo">
    <a href="/" class="simple-text logo-mini">
      PS
    </a>
    <a href="/" class="simple-text logo-normal">
      Polling System
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      <li class="active ">
        <a href="/">
          <i class="now-ui-icons design_app"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li>
        <a href="{{ route('polls.index') }}">
          <i class="fas fa-vote-yea"></i>
          <p>Polls</p>
        </a>
      </li>
       <li>
        <a href="/users">
          <i class="fas fa-users"></i>
          <p>Users List</p>
        </a>
      </li>
    
      <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
          <i class="fa fa-lock"></i>
          <p>Logout</p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
      </li>
  
    </ul>
  </div>
</div>