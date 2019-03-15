<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailingController extends Controller
{
        
    public function add()
    {
        return view('mailing.add'); 
    }
    
    public function store(\App\Http\Requests\MailingStoreRequest $request)
    {
        $data               = [];
        $input['email']     = $request['email'];
        $input['ip']        = $request->ip();
        $input['remember_token'] = str_random(40);
        // TODO controllo tempo di arrivo delle richieste
        $mailing = new \App\Mailing($input);
        try{
            $mailing->save();
            $data['email'] = $mailing->email;
            // Invio email
            //Mail::to($user->email)->send(new \App\Mail\MailingStore(NULL));
        } catch (\Exception $e){
            return view('mailing.exception', ['ex' => $e->getMessage()] );
        }
        return view('mailing.confirm', $data);
    }
}
