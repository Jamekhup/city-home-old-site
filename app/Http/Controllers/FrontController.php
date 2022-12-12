<?php

namespace App\Http\Controllers;

use App\Mail\contactMail;
use Illuminate\Http\Request;
use App\Models\adminProperty;
use Illuminate\Support\Str;
use App\Models\subscriber;
use App\Mail\subMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\userProperty;

error_reporting(0);
class FrontController extends Controller
{
    public function index(){
        return view('home');
    }

    public function contact()
    {
        return view('contact');
    }

    public function contactMail(Request $request){
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
            'subject' => 'required',
            'sms' => 'required',
        ]);

        $name = $request->name;
        $phone = $request->phone;
        $subject = $request->subject;
        $sms = $request->sms;

        $details = [
            'name' => $name,
            'phone' => $phone,
            'subject' => $subject,
            'sms' => $sms
        ];

        Mail::to('cityhomeproperty@gmail.com')->send(new contactMail($details));

        return back()->with('success','Thanks for contacting us.');
    }


    public function property(Request $request, $saleRent, $category){
        $property = adminProperty::where('saleRent',$saleRent)
        ->where('category',$category)->orderBy('created_at','desc')->paginate(9);
        if($request->ajax()){
            $view = view('fetch-to-load',compact('property'))->render();
            return response()->json(['html'=>$view]);
        }
        return view('property',compact('property'));

    }

    public function propertyDetail($saleRent, $category, $id){
        $property = adminProperty::where('saleRent', $saleRent)
        ->where('category', $category)->orderBy('created_at', 'desc')->get();

        $detail = adminProperty::where('saleRent', $saleRent)
        ->where('category', $category)
        ->where('id', $id)->get();

        return view('property-detail', compact('property','detail'));
        
    }


    public function mainProperty(Request $request, $saleRent){
        $property = adminProperty::where('saleRent', $saleRent)
        ->orderBy('created_at', 'desc')->paginate(9);
        if ($request->ajax()) {
            $view = view('fetch-to-load', compact('property'))->render();
            return response()->json(['html' => $view]);
        }
        return view('main-property', compact('property'));
    }

    public function mainPropertyDetail($saleRent, $id)
    {
        $property = adminProperty::where('saleRent', $saleRent)
            ->orderBy('created_at', 'desc')->get();

        $detail = adminProperty::where('saleRent', $saleRent)
            ->where('id', $id)->get();

        return view('main-property-detail', compact('property', 'detail'));
    }


    // subscriber and send confirmation mail
    public function subscribe(Request $request){
        $request->validate([
            'email' => 'required|unique:subscribers,email|email|max:225'
        ]);
        $rand = Str::random(60);
        $email = $request->email;

        $sub = new subscriber;
        $sub->email = $request->email;
        $sub->token = $rand;
        $sub->save();

        $details = [
            'title' => 'Click the below button to confirm your subscribed email',
            'link'  => $rand,
        ];

        Mail::to($email)->send(new subMail($details));

        return response()->json(['success'=>'Subscribe Success. Please check your email to continue']);
    }

    public function confirmSubscribe(Request $request, $token){
        $sub = subscriber::where('token',$token)->limit(1)->get();

        $mytoken = $sub[0]->token;
        $verify = $sub[0]->email_verify;

        if($mytoken =="" || !$verify==""){
            return "wrong token or expired";
        }else{
            $current = date('h:i:sa');

            if ($mytoken != '' and $verify == null and $mytoken == $token) {
                DB::table('subscribers')
                ->where('token', $mytoken)
                ->update(['email_verify' => $current, 'token' => '']);

                return redirect()->route('home')->with('success-sub','Thanks your subscribing. From now on, new updated properties information will be sent to your email.');
            } else {
                return 'Link expired or wrong token or something is wrong';
            }
        }
        
    }


    // user listings
    public function userlists(Request $request){
        $property = userProperty::where('approve',0)
        ->orderBy('created_at', 'desc')->paginate(9);
        if ($request->ajax()) {
            $view = view('fetch-to-load', compact('property'))->render();
            return response()->json(['html' => $view]);
        }
        return view('userlists', compact('property'));
    }

    public function userlistsDetail($id){
        $property = userProperty::where('approve', 0)
            ->orderBy('created_at', 'desc')->get();

        $detail = userProperty::where('approve',0)
            ->where('id', $id)->get();

        return view('userlists-detail', compact('property', 'detail'));
    }


    // terms and conditions
    public function condition(){
        return view('terms-conditions');
    }
}
