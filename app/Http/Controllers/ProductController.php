<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $message = [
        'sku.required' => 'กรอก SKU',
        'sku.unique' => 'SKU นี้มีอยู่แล้ว',
        'name.required' => 'กรอกชื่อสินค้า',
        'price.numeric' => 'ราคาต้องเป็นตัวเลข',
    ];
    public function index()
    {

        try{
           // $products = Product::all();
        $products = Product::orderBy('id','asc')->paginate(10);
        return view('products.index',compact('products'));
        }catch(\Exception $e){
            return view('error.404');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
         $request->validate([
            'sku' => 'required|unique:products,sku',
            'name' => 'required',
            'price' => 'nullable|numeric',
        ],$this->message);

     Product::create($request->all());
        return redirect()->route('products.index')->with('status', 'Product created successfully.');
        }catch(\Exception $e){
            return redirect()->back()->with('status', 'Failed to create product: ' . $e->getMessage());
            } 
    }
        
       

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try{
            $request->validate([
                'sku' => 'required|unique:products,sku,' . $product->id,
                'name' => 'required',
                'price' => 'nullable|numeric',
        ],$this->message);

            $product->update($request->all());
            return redirect()->route('products.index')->with('status', 'Product updated successfully.');
        } catch(\Exception $e){
            return redirect()->back()->with('status', 'Failed to update product: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('status', 'Product deleted successfully.');
    }
}
