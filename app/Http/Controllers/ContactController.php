<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = Contact::orderBy('id', 'DESC')->get();
        return view('admin.contact.index', compact('contact'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validasi = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required'
            ]);
            $contact = Contact::create($validasi);
            return back()->with('Success', 'Pesan sudah terkirim ke admin!');
        } catch (ValidationException $th) {
            return back()->withErrors(['Error' => 'Failed to send']);
        }
    }

    public function reply(Request $request, $id) 
    {
        $contact = Contact::find($id);
        $validasi = $request->validate(['reply' => 'required']);
        $contact->update($validasi);

        Mail::raw($request->reply, function ($message) use ($contact){
            $message->to($contact->email)->subject('Balasan dari admin' . $contact->subject);
        });

        return back()->with('seccess', 'Balasan terkirim ke email User!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
