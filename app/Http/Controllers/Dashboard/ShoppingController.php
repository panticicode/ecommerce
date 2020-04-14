<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;
use App\Models\Product;

class ShoppingController extends Controller
{
    public function add_to_cart()
    {
    	$request = request();
    	$product = Product::find($request->product_id);
    	$cartItem = Cart::add([
    		'id' => $product->id,
    		'name' => $product->name,
    		'qty' => $request->qty,
    		'price' => $product->price
    	]);
    	Cart::associate($cartItem->rowId, 'App\Models\Product');
    	return redirect()->route('cart');
    }
    public function cart()
    {
    	//Cart::destroy();
    	return view('cart');
    }
    public function cart_delete($id)
    {
    	Cart::remove($id);
    	return redirect()->back();
    }
    public function cart_reduce($id, $qty)
    {
    	Cart::update($id, $qty - 1);
    	return redirect()->back();
    }
    public function cart_increase($id, $qty)
    {
    	Cart::update($id, $qty + 1);
    	return redirect()->back();
    }
    public function rapid_add($id)
    {
        $request = request();
        $product = Product::find($id);
        $cartItem = Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price
        ]);
        Cart::associate($cartItem->rowId, 'App\Models\Product');
        return redirect()->back();
    }
}
