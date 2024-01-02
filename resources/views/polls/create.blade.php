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
                <h3 class="card-category">New Poll</h3>
                <h6 class="card-title">
                  <a href="{{ route('polls.index') }}" class="btn btn-warning">  <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                </h6>
              </div>
              <div class="container">
                    <form class="col s12" method="post" action="{{route('polls.store')}}">
            
                    @csrf
                    <div class="row">
                    </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <input required="required" name="title" id="title" type="text" class="validate">
                                <label for="title">Title</label>
                                @error('title')
                                {{$message}}
                                @enderror
                            </div>
            
            
                            <div class="input-field col s4">
                                <input required="required" type="text" class="datepicker" placeholder="start date" name="start_date">
                                <label for="title">start date</label>
                                @error('start_at')
                                {{$message}}
                                @enderror
                            </div>
                            <div class="input-field col s4">
                                <input required="required" type="text" class="timepicker" placeholder="start time" name="start_time">
                                <label for="title">start time</label>
                            </div>
                            <div class="input-field col s4">
                                <input required="required" type="text" class="datepicker" placeholder="end date" name="end_date">
                                <label for="title">end date</label>
                            </div>
            
                            <div class="input-field col s4">
                                <input required="required" type="text" class="timepicker" placeholder="end time" name="end_time">
                                <label for="title">end time</label>
                                @error('end_at')
                                {{$message}}
                                @enderror
                            </div>
            
            
                        </div>
            
                        @php
                        $a=[1,2,3,4];
                        @endphp
                        <div class="input-field col s4" x-data="{
                            optionsNumber:2
                        }">
                            <h4>
                                Options
                            </h4>
                            <template x-for="i,index in optionsNumber">
                                <div class="row">
                                    <div class="col s6">
                                        <input required="required" name="options[][content]" id="title" type="text" class="validate" :placeholder="`Option` + i">
                                    </div>
            
                                    <div class="col s6">
                                        <button
                                            x-on:click="optionsNumber > 2 ? optionsNumber-- : alert('poll must has at least 2 options')"
                                            class="waves-effect waves-light btn orange darken-4" type="button">
                                            remove
                                        </button>
                                    </div>
                                </div>
                        </div>
                        </template>
                        <button x-on:click="optionsNumber++" class="waves-effect waves-light btn success darken-2" type="button">
                            add option
                        </button>
                        <hr>
                        <div class="center">
            
                            <button class="waves-effect waves-light btn cyan darken-2" type="submit">
                                Save
                            </button>
                        </div>
                </div>
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