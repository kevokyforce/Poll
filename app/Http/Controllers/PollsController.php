<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\PollStatus;
use App\Http\Requests\CreatePollRequest;
use App\Http\Requests\UpdatePollRequest;
use App\Http\Requests\VoteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
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
        $polls = Poll::latest()->get(); 
        
        return view('polls.index', compact('polls'));
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

        return redirect()->route('polls.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get the authenticated user's ID
        $user_id = Auth::id();
        
        // Retrieve the poll with options for the specified poll ID
        $poll = Poll::with('options')->findOrFail($id);
        
        // Check if the authenticated user has voted in this poll
        $confirm = Vote::where('user_id', $user_id)->where('poll_id', $id)->exists();
        
        // Get the selected option ID if the user has voted
        $selectedOptionId = null;
        if ($confirm) {
            $vote = Vote::where('user_id', $user_id)->where('poll_id', $id)->first();
            $selectedOptionId = $vote->option_id;
        }
        
        // Pass the retrieved data to the view
        return view('polls.show', compact('poll', 'confirm', 'selectedOptionId'));
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
        // Retrieve the poll with the given ID
        $poll = Poll::findOrFail($id);
    
        // Pass the poll to the view
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
        try {
            // Retrieve the poll you want to update
            $poll = Poll::findOrFail($id);
    
            // Extract data from the request, excluding specific fields
            $data = $request->except(['options']);
    
            // Update the poll with the extracted data
            $poll->update($data);
    
            // Delete existing options associated with the poll
            $poll->options()->delete();
    
            // Create new options based on the request data
            $poll->options()->createMany($request->options);
    
            // Redirect to the index page with success message
            return redirect()->route('polls.index')->with('success', 'Poll updated successfully.');
        } catch (\Exception $e) {
            // Redirect back with error message if an exception occurs
            return redirect()->back()->with('error', 'Failed to update poll: ' . $e->getMessage());
        }
    }
    
    
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Retrieve the poll you want to delete
        $poll = Poll::findOrFail($id);
    
        // Delete associated votes
        Vote::whereHas('option', function ($query) use ($poll) {
            $query->where('poll_id', $poll->id);
        })->delete();
    
        // Delete options associated with the poll
        $poll->options()->delete();
    
        // Delete the poll itself
        $poll->delete();
    
        // Return success message
        return back()->with('success', 'Poll deleted successfully.');
    }
}
