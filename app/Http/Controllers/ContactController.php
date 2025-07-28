<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Mail\ContactMessageMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'phone' => ['nullable', 'string', 'regex:/^\+374\d{8}$/'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:5', 'max:5000'],
        ], [
            'name.required' => 'Անունը պարտադիր է։',
            'email.required' => 'Էլ․ փոստը պարտադիր է։',
            'email.email' => 'Մուտքագրեք վավեր էլ․ փոստի հասցե։',
            'message.required' => 'Հաղորդագրության դաշտը չի կարող դատարկ լինել։',
        ]);


        ContactMessage::create($validated);

        Mail::to('info@edhouse.am')->send(new ContactMessageMail($validated));

        return back()->with('success', 'Հաղորդագրությունը հաջողությամբ ուղարկվեց։');
    }
}
