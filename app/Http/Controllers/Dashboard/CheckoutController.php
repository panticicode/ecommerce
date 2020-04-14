<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Cart;
use Stripe\Charge;
use Stripe\Stripe;
use Session;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout');
    }
    public function pay()
    {
    	$request = request();
    	Stripe::setApiKey("sk_test_tpcEOq2EGF9GoE4elFJSaqBI00pZ45n0aq");
    	$token = $request->stripeToken;
    	$charge = Charge::create([
    		'amount' => Cart::total() * 100,
    		'currency' => 'usd',
    		'description' => 'Test Description',
    		'source' => $token
    	]);
    	Session::flash('success', 'Purchase successfull. wait for our email');
    	Mail::to($request->stripeEmail)->send(new \App\Mail\PurchaseSuccessful);
    	Cart::destroy();
    	return redirect()->route('index');
    }
}
