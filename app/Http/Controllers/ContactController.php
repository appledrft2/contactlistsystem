<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\SharedContact;
use App\Models\Friend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::where('user_id', Auth::user()->id)->get();
        $shared_contacts = SharedContact::where('user_id', Auth::user()->id)->get();
        return view('contact.index', ['contacts' => $contacts, 'shared_contacts' => $shared_contacts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
        ]);

        Contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'company' => $request->company,
            'user_id' => Auth::user()->id
        ]);

        return redirect(route('contacts.index'))
            ->with('success', 'Contact Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('contact.edit', ['contact' => $contact]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
        ]);
        $contact->update($validated);
        return redirect(route('contacts.index'))
            ->with('success', 'Contact Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect(route('contacts.index'))
            ->with('success', 'Contact Successfully Deleted');
    }

    public function shareContact($id)
    {
        $friends = Friend::where('user_id', Auth::user()->id)->get();
        return view('contact.share', ['contact_id' => $id, 'friends' => $friends]);
    }
    public function shareContactStore(Request $request, $id)
    {
        $validated = $request->validate(['friends' => 'required']);
        $contact = Contact::findOrFail($id);

        foreach ($request->friends as $friend_id) {
            SharedContact::create([
                'contact_id' => $contact->id,
                'user_id' => $friend_id
            ]);
        }

        return redirect(route('contacts.index'))
            ->with('success', 'Contact Successfully Shared');
    }
}
