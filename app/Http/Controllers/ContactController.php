<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:100',
            'email'  => 'required|email',
            'subjek' => 'required|string|max:200',
            'pesan'  => 'required|string',
        ]);

        Mail::raw(
            "Dari: {$request->nama} ({$request->email})\n\nSubjek: {$request->subjek}\n\nPesan:\n{$request->pesan}",
            function ($message) use ($request) {
                $message->to(config('mail.from.address'))
                        ->subject('Pesan Kontak: ' . $request->subjek)
                        ->replyTo($request->email, $request->nama);
            }
        );

        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
    }
}