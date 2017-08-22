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


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $contacts = Contact::all();
        return view('contacts.list',compact('contacts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){

        return view('contacts.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id){

        $contact = Contact::findorfail($id);
        return view('contacts.edit',compact('contact'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request){

        $request->published_at = Carbon::now();

        $contact = Contact::find($id);
        $contact->fullname      = $request->fullname;
        $contact->email         = $request->email;
        $contact->telephone     = $request->telephone;

        $contact->save();

        return redirect('contacts');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id){

        $contact = Contact::find($id);
        $contact->delete();
        return redirect('contacts');

    }


}
