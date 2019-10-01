<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('Customers.list', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    public function create()
    {
        return view('Customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob = $request->input('dob');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $patch = $image->store('image', 'public');
            $customer->image = $patch;
        }

        $customer->save();


        Session::flash('success', 'Tạo mới khách hàng thành công');

        return redirect()->route('customers.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('Customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob = $request->input('dob');

        if ($request->hasFile('image')) {
            $currentImg = $customer->image;
            if ($currentImg) {
                Storage::delete('/public/' . $currentImg);
            }
            $image = $request->file('image');
            $patch = $image->store('image', 'public');
            $customer->image = $patch;

        }


        $customer->save();


        Session::flash('success', 'Cập nhật khách hàng thành công');

        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        //dung session de dua ra thong bao
        Session::flash('success', 'Xóa khách hàng thành công');


        return redirect()->route('customers.index');
    }
}
