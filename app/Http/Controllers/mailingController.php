<?php

namespace App\Http\Controllers;

use App\Mail\requestApply;
use App\Mail\shareOnEmail;
use App\Mail\tourRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class mailingController extends Controller
{
    public function shareEmail(Request $request){
        $request->validate([
            'email' => 'required|email',
            'url' => 'required',
        ]);

        $email = $request->email;
        $url = $request->url;
        $sms = $request->sms;

        $details = [
            'url' => $url,
            'sms' => $sms,
        ];

        Mail::to($email)->send(new shareOnEmail($details));

        return response()->json(['success'=>'Email Sent Successfully']);
    }



    public function requestApply(Request $request){
        $request->validate([
            'email' => 'required|email',
            'url' => 'required',
            'name' => 'required',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9'
        ]);

        $url = $request->url;
        $sms = $request->sms;
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;

        $details = [
            'url' => $url,
            'sms' => $sms,
            'name' => $name,
            'phone' => $phone,
            'email' => $email
        ];

        Mail::to('cityhomeproperty@gmail.com')->send(new requestApply($details));

        return response()->json(['success' => 'Email Sent Successfully']);
    }


    public function requestTour(Request $request){
        $request->validate([
            'date' => 'required',
            'time' => 'required',
            'type' => 'required',
            'email' => 'required|email',
            'name' => 'required',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9'
        ]);

        $date = $request->date;
        $time = $request->time;
        $type = $request->type;
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;

        $details = [
            'date' => $date,
            'time' => $time,
            'type' => $type,
            'name' => $name,
            'phone' => $phone,
            'email' => $email
        ];

        Mail::to('cityhomeproperty@gmail.com')->send(new tourRequest($details));

        return response()->json(['success' => 'Email Sent Successfully']);
    }
}
