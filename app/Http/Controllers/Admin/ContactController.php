<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.contacts.index', compact('contacts'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        if ($contact->status === 'pending') {
            $contact->update(['status' => 'read']);
        }
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        if ($contact->status === 'pending') {
            $contact->update(['status' => 'read']);
        }

        return view('admin.contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'reply' => 'required|string|min:10',
        ], [
            'reply.required' => 'Yanıt metni gereklidir.',
            'reply.min' => 'Yanıt metni en az 10 karakter olmalıdır.',
        ]);

        $contact->update([
            'reply' => $validated['reply'],
            'status' => 'replied',
            'replied_at' => now(),
        ]);

        // TODO: Send email to user with reply

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Mesaj başarıyla yanıtlandı.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'İletişim mesajı silindi.');
    }
}
