<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        // $products = Products::latest()->get();
        $products = Products::latest()->paginate(2);
        // $products = Products::all();
        return view("products.index", ["products"=> $products]);
    }

    public function create(){
        return view("products.create");
    }

    public function store(Request $request){
        // $imageName = time().".".$request->image_extension;
        // // $image = $request->image;
        // $request->image->move(public_path('products'), $imageName);
        // dd($request->all());

        //Validate Data
        $request->validate([
            'name'=>'required',
            'image'=> 'required|mimes:png,jpg,jpeg,gif',
            'description' => 'required',
        ]);

        $image = $request->file('image');
        $extention = $image->getClientOriginalExtension();  

        $filename = time().'.'.$extention;

        $path = 'products';
        $image->move($path, $filename);
        // dd($filename);

        $product = new Products();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $filename;

        $product->save();

        return back()->with('success','Product Added Successfully');
        // return redirect('/')->with('success','Product Added Successfully');

    }

    public function edit($id){
        $product = Products::where('id', $id )->first();
        // dd($id);
        return view('products.edit', ['product'=> $product]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'image'=> 'nullable|mimes:png,jpg,jpeg,gif',
            'description' => 'required',
        ]);
        $product = Products::where('id', $id)->first();
        if(isset($request->image)){
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();  
            $filename = time().'.'.$extention;
            $path = 'products';
            $image->move($path, $filename);
            $product->name = $request->name;
        }

        // dd($filename);
        $product->description = $request->description;
        $product->image = $filename;

        $product->save();

        return back()->with('success','Product Updated Successfully');
    }

    public function destroy($id){
        $product = Products::where('id', $id)->first();
        $product->delete();
        return back()->with('danger','Deleted Successfully');
    }

    public function view($id){
        $product = Products::where('id', $id)->first();
        return view('view', ['product'=> $product]);
    }
}
