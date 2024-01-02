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
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-category">Vote</h3>
                <h6 class="card-title">
                  <a href="{{ route('polls.index') }}" class="btn btn-warning">  <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                </h6>
              </div>
             
    <div class="container">

        <h4 class="center">
        </h4>

        <h6>
          
        </h6>

        <form action="/polls/{id}/vote" method="post">
            @csrf

            @foreach($polls as $option)

               <p>
                <label>
                  <input name="option_id" type="radio" value="{{$option->id}}" @if ($polls == $option->id) checked @endif />
                  <span>{{$option->content}}  {{$option->votes_count}}</span>
                </label>
            </p>
            <input type="hidden" name="poll_id" value="{{$option->poll_id}}">
            @endforeach
            
              @if(empty($confirm))
            <button class="waves-effect waves-light btn info darken-2" type="submit">
                vote
            </button>
                        @else
                <p>Thank you for Voting</p>
            @endif
        </form>
    </div>

            </div>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var dates = document.querySelectorAll('.datepicker');
                    var instances = M.Datepicker.init(dates);
                    var tiems = document.querySelectorAll('.timepicker');
                    var instances = M.Timepicker.init(tiems);
                  });
            </script>
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

