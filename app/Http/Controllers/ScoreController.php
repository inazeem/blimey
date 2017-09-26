<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Score;
use Session;
use Carbon\Carbon;

class ScoreController extends Controller
{
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator($request)
    {
        $this->validate($request, [
            'time'           => 'required',
            'runner_id'      => 'required',
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scores  = Score::orderBy('score')->get();
        $contacts = Contact::all();;
        return view('scores.leaderboard',compact('scores','contacts'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $score= new Score;
        $request->published_at = Carbon::now();
        $score->score       = $request->time;
        $score->runner_id   = $request->runner_id;
        $score->save();
        Session::put('score_added', 'Score Successfully Added');
        return redirect('/leaderboard');
    }

    public function destroy($id){

        $score = score::find($id);

        $score->delete();

        Session::put('score_deleted', 'Score Successfully Deleted');

        return redirect('leaderboard');
    }
}
