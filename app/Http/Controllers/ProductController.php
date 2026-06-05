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
        'sku.required' => 'กรอก สินค้า',
        'sku.unique' => 'รหัสสินค้า นี้มีอยู่แล้ว',
        "sku.size" => 'รหัสสินค้า ต้องมีความยาว :size ตัวอักษร',
        'name.required' => 'กรอกชื่อสินค้า',
        'name.min' => 'ชื่อสินค้าต้องมีความยาวอย่างน้อย :min ตัวอักษร',
        'name.max' => 'ชื่อสินค้าต้องมีความยาวไม่เกิน :max ตัวอักษร',
        'price.numeric' => 'ราคาต้องเป็นตัวเลข',
        'price.min' => 'ราคาต้องมากกว่าหรือเท่ากับ :min',
        'image.image' => 'ไฟล์ที่อัปโหลดต้องเป็นรูปภาพ (เช่น jpeg, png)',
        'image.max' => 'ขนาดไฟล์รูปภาพต้องไม่เกิน :max กิโลไบต์',
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
            // ขั้นตอน1: Validate ข้อมูลที่รับมาจากฟอร์ม
         $request->validate([
            'sku' => 'required|string|size:13|unique:products,sku',
            'name' => 'required|string|min:3|max:255',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048', // เพิ่มการตรวจสอบไฟล์ภาพ
        ],$this->message);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $imagePath = $request->file('image')->storeAs('product/images',$filename, 'public');
            }

            // dd($imagePath;
        // ขั้นตอน2: สร้างสินค้าใหม่ในฐานข้อมูล
     Product::create([
        'sku' => $request->input('sku'),
        'name' => $request->input('name'),
        'price' => $request->input('price'),
        'image' => $imagePath,
        ]);
            // ขั้นตอน3: Redirect กลับไปที่หน้ารายการสินค้า พร้อมแสดงข้อความสำเร็จ  
        return redirect()->route('products.index')->with('status', ['status' => 'success', 'title' => 'Success', 'message' => 'Product created successfully.']);
        }catch(\Exception $e){
          return back()->with('status', ['status' => 'error', 'title' => 'Error', 'message' =>$e->getMessage()]);
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
                'sku' => 'required|string|size:13|unique:products,sku,' . $product->id,
                'name' => 'required|string|min:3|max:255',
                'price' => 'nullable|numeric|min:0',
                'image' => 'nullable|image|max:2048', 
        ],$this->message);

            $imagePath = $product->image;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('product/images', 'public');
            }
            $request->merge(['image' => $imagePath]);

            $product->update($request->all());
            return redirect()->route('products.index')->with('status', ['status' => 'success', 'title' => 'Success', 'message' => 'Product updated successfully.']);
        } catch(\Exception $e){
            return back()->withInput()->with('status', ['status' => 'error', 'title' => 'Error', 'message' =>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
      return redirect()->route('products.index')->with('status', ['status' => 'success', 'title' => 'Success', 'message' => 'Product deleted successfully.']);
    }
    }

