<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\PollStatus;
use App\Http\Requests\CreatePollRequest;
use App\Http\Requests\UpdatePollRequest;
use App\Http\Requests\VoteRequest;
use App\Models\Option;
use App\Models\Poll;
use App\Models\Vote;
use DB;

class PollsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  $polls = auth()->user()->polls()->select('title','status','id')->paginate(10);
        $polls = DB::table('polls')->get();
        

        return view('polls.index')->with('polls', $polls);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('polls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePollRequest $request)
    {
        $poll = auth()->user()->polls()->create($request->safe()->except('options'));

        $poll->options()->createMany($request->options);

        return view('polls.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = auth()->user()->id;
        $polls = DB::table('options')->where('poll_id', $id)->get();

        $confirm = DB::table('votes')->where('user_id', $user_id)->where('poll_id',$id)->first();


        return view('polls.show', compact('polls', 'confirm'));
    }

    public function vote(VoteRequest $request, $id)
    {

        // abort_if($poll->status != PollStatus::STARTED->value, 404);
        $selectedOption = DB::table('options')->where('poll_id', $id)->get();

        $poll = DB::table('votes')->where('option_id', $id)->get();

        $newOption =  Option::find($request->option_id);
        $newOption->increment('votes_count');

          $votes = new Vote;
          $votes->poll_id = $request->poll_id;
          $votes->user_id = auth()->user()->id;
          $votes->option_id = $request->option_id;
          $votes->save();
        return back();
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // abort_if(auth()->user()->isNot($poll->user), 403);
        // abort_if($poll->status != PollStatus::PENDING->value, 404);

        $poll = DB::table('options')->where('id', $id)->get();
        return view('polls.update', compact('poll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->safe()->except('options');

        $poll->update($data);

        $poll->options()->delete();

        $poll->options()->createMany($request->options);

        return to_route('polls.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

        $poll->options()->delete();

        $poll->delete();

        return back();
    }
}
