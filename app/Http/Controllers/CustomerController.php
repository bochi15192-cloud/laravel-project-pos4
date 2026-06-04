<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

        protected $message = [
                'name.required' => 'กรอกชื่อลูกค้า',
                'name.min' => 'ชื่อลูกค้าต้องอย่างน้อย :min ตัวอักษร',
                'name.max' => 'ชื่อลูกค้าต้องไม่เกิน :max ตัวอักษร',
                'email.required' => 'กรอกอีเมลลูกค้า',
                'email.email' => 'กรอกอีเมลให้ถูกต้อง',
                'email.unique' => 'อีเมลนี้มีอยู่แล้ว',
                'phone.max' => 'เบอร์โทรต้องไม่เกิน :max ตัวอักษร',
                ];
    public function index()
    {
        try{
             // $customers = Customer::all();
        $customers = Customer::orderBy('id', 'asc')->paginate(10);
        // "name ,id created_at,": เรียงลำดับ
        return view('customers.index' ,compact('customers'));
        }catch(\Exception $e){
            return view('error.404');
        }
       
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function create()
    {
     
       return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            try {
                 $request->validate([
                    'name' => 'required|string|min:3|max:255',
                    'email' => 'required|email|unique:customers,email',
                    'phone' => 'nullable|string|max:20',
                ],$this->message);
                Customer::create($request->all());
                // Customer::create($request->only('name', 'email', 'phone'));
                return redirect()->route('customers.index')->with('status', 'Customer created successfully.');
            }catch(\Exception $e){
                return redirect()->route('customers.index')->with('status', 'Failed to create customer: ' . $e->getMessage());
            } 
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit',compact('customer'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
       try{
           $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:customers,email,'.$customer->id,
            'phone' => 'nullable|string|max:20',
        ], $this->message);

        $customer->update($request->only('name', 'email', 'phone'));
        return redirect()->route('customers.index')->with('status', 'Customer updated successfully.');
       }
       catch(\Exception $e){
        return redirect()->route('customers.index')->with('status', 'Failed to update customer: ' . $e->getMessage());
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('status', 'Customer deleted successfully.');
    }
}
