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
      <div class="panel-header panel-header-lg">
        <canvas id="bigDashboardChart"></canvas>
      </div>
      <div class="content">
        <div class="row">
            @foreach($polls as $poll)
          <div class="col-lg-4 col-md-6">
              
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category"> {{$poll->title}}</h5>
                <h4 class="card-title"></h4>
                
              </div>
              <div class="card-body">
                <p>Title: {{$poll->title}}</p>
                <p><a href="{{route('polls.show',[$poll->id])}}"><i class="btn btn-info"> Vote Now</i></a></p>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                </div>
              </div>
               
            </div>
            
          
          </div>
          @endforeach
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