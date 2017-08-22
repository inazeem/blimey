<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Contact;
use Carbon\Carbon;

class ContactController extends Controller
{
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
            'fullname'          => 'required|max:255',
            'email'             => 'required|unique:contacts|max:255',
            'telephone'         => 'required|max:255',
        ]);
    }


    //
    public function index(){

        $contacts = Contact::all();
        return view('contacts.list',compact('contacts'));
    }

    public function create(){

        return view('contacts.create');
    }

    public function store(Request $request){

        $this->validator($request);

        $request->published_at = Carbon::now();

        $contact = new Contact;
        $contact->fullname      = $request->fullname;
        $contact->email         = $request->email;
        $contact->telephone     = $request->telephone;

        $contact->save();

        return redirect('contacts');
    }

    public function edit($id){

        $contact = Contact::findorfail($id);
        return view('contacts.edit',compact('contact'));
    }

    public function update($id, Request $request){

        $request->published_at = Carbon::now();

        $contact = Contact::find($id);
        $contact->fullname      = $request->fullname;
        $contact->email         = $request->email;
        $contact->telephone     = $request->telephone;

        $contact->save();

        return redirect('contacts');
    }

    public function destroy($id){

        $contact = Contact::find($id);
        $contact->delete();
        return redirect('contacts');

    }


}
