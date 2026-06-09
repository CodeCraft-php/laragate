<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->getMessages();

        return view('messages.overview', compact('data'));
    }

    public function incoming()
    {
        $data = $this->getMessages()['inbox'] ?? [];

        return view('messages.incoming', compact('data'));
    }
    public function outgoing()
    {
        $data = $this->getMessages()['messages'] ?? [];

        return view('messages.outgoing', compact('data'));
    }

    public function getMessages()
    {
        $data = [];

        $messages  = Http::SmsGateApi()->get('/messages');
        $inbox = Http::SmsGateApi()->get('/inbox');
        if($messages->failed() || $inbox->failed()) {
            $data['error'] =  "Connexion à SmsGate échouée : " . $messages->status()  . ' / ' . $inbox->status();
            $messages = [];
            $inbox = [];
        } else {
            $messages = $messages->json();
            $inbox = $inbox->json();
        }
        $data['messages'] = $messages;
        $data['inbox'] = $inbox;

        return $data;
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
        dd($request->all());
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
