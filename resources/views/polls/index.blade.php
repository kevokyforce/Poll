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
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-category">All Polls List</h5>
                <h5 class="card-title">
                  <a href="{{ route('polls.create') }}" class="btn btn-info">  <i class="fa fa-plus" aria-hidden="true"></i> Add New Poll</a>
                </h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Title
                      </th>
                      <th>
                        Status
                      </th>
                      <th>
                        Action
                      </th>
                    </thead>
                    <tbody>
                      @foreach($polls as $poll)
                      <tr>
                          <td>{{$poll->title}}</td>
                          <td>{{$poll->status}}</td>
                          <td>
                              <a class="waves-effect waves-light btn info darken-2" href="{{route('polls.edit',[$poll->id])}}">
                              update
                              </a>
          
                              <a class="waves-effect waves-light btn red darken-2" href="{{route('polls.destroy',[$poll->id])}}">
                              delete
                              </a>
          
                              <a class="waves-effect waves-light btn green lighten-0" href="{{route('polls.show',[$poll->id])}}">
                              show
                              </a>
                          </td>
                        </tr>
          
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
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