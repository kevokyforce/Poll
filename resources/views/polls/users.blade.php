<!DOCTYPE html>
<html lang="en">

    {{-- Start of Header --}}

        @include('inc.header')

    {{-- End of Header --}}

<body class="">
  <div class="wrapper ">

     {{-- Sidebar --}}

       @include('inc.sidebar')

     {{-- End of Sidebar --}}

    <div class="main-panel" id="main-panel">
      <!-- Navbar -->

       @include('inc.sidenavbar')

      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
         @foreach($users as $user)
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="../assets/img/bg5.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="../assets/img/mike.jpg" alt="...">
                    <h5 class="title">{{ $user->name}}</h5>
                  </a>
                  <p class="description">
                    {{ $user->email}}
                  </p>
                </div>
              </div>
            </div>
          </div>
          
            @endforeach
        </div>
      </div>
      
       
      {{-- Footer --}}

       @include('inc.footer')

      {{-- End of Footer --}}
    </div>
  </div>
       {{-- JavaScript --}}

        @include('inc.js')

       {{-- End of Javascript --}}
</body>

</html>