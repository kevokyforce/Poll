
<div class="container">
    <div class="row">
    <h3>
        Update Poll :
    </h3>
        <form class="col s12" method="post" action="{{route('polls.update', [$poll])}}">
        @method('PUT')
        @csrf
        <div class="row">
        </div>
            <div class="row">
                <div class="input-field col s4">
                    <input required="required" name="title" id="title" type="text" class="validate" value="{{$poll->title}}">
                    <label for="title">Title</label>
                </div>
                <div class="input-field col s4">
                    <input required="required" type="text" class="datepicker" placeholder="start date" name="start_date" value="{{$poll->start_date}}">
                    <label for="title">start date</label>
                </div>

                <div class="input-field col s4">
                    <input required="required" type="text" class="timepicker" placeholder="start time" name="start_time" value="{{$poll->start_time}}">
                    <label for="title">start time</label>
                </div>
                <div class="input-field col s4">
                    <input required="required" type="text" class="datepicker" placeholder="end date" name="end_date" value="{{$poll->end_date}}">
                    <label for="title">end date</label>
                </div>

                <div class="input-field col s4">
                    <input required="required" type="text" class="timepicker" placeholder="end time" name="end_time" value="{{$poll->end_time}}">
                    <label for="title">end time</label>
                </div>
            </div>

            <div class="row col s12" x-data="{
                optionsNumber:{{count($poll->options)}},
                options: {{json_encode($poll->options)}},
                removeOption(id) {

                    if (this.optionsNumber == 2) {
                        alert('each poll must has at least 2 options');
                        return ;
                    }
                    this.options = this.options.filter(function(option){
                        return option.id != id
                    });

                    this.optionsNumber =  this.options.length
                },

                addOption(){
                    this.options.push({id:Math.random()});
                }
            }">
                <h4>
                    Options
                </h4>
                <template x-for="option,i in options">
                    <div class="row">
                        <div class="col s6">
                            <input required="required" name="options[][content]" id="title" type="text" class="validate" :placeholder="`Option ` + (i + 1)" :value="option.content">
                        </div>

                        <div class="col s6">
                            <button
                                x-on:click="removeOption(option.id)"
                                class="waves-effect waves-light btn red darken-4" type="button">
                                remove
                            </button>
                        </div>
                    </div>
            </div>
            </template>
            <button x-on:click="addOption()" class="waves-effect waves-light btn info darken-2" type="button">
                add option
            </button>
            <hr>
            <div class="center">

                <button class="waves-effect waves-light btn indigo darken-2" type="submit">
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

