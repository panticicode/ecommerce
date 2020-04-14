<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $products = Product :: all();
        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'image' => 'required|image',
            'description' => 'required'
        ]);
        $image = $request->image;
        $new_image = time() . $image->getClientOriginalName();
        $image_path = 'uploads/products/';
        $image->move($image_path, $new_image);
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image_path. $new_image,
            'description' => $request->description
        ]);
        Session::flash('success', 'Product created succesfully');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);
        $product = Product::find($id);
        if($request->hasFile('image'))
        {
            if(file_exists($product->image))
            {
                unlink(public_path(). '/' . $product->image);
            }
            $image = $request->image;
            $new_image = time() . $image->getClientOriginalName();
            $image_path = 'uploads/products/';
            $image->move($image_path, $new_image);
            $product->image = $image_path. $new_image;
        }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();
        Session::flash('info', 'Product updated succesfully');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(file_exists($product->image))
        {
            unlink(public_path(). '/' . $product->image);
        }
        $product->delete();
        Session::flash('danger', 'Product deleted');
        return redirect()->back();
    }
}
