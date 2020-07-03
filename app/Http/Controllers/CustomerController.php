<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'DESC')->paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function show($id)
    {
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required|max:13',
            'address' => 'required|string',
            'email' => 'required|email|string|unique:customers,email'
        ]);

        try {
            $customer = Customer::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email
            ]);

            return redirect('/customer')->with([
                'success' => 'Data ' . $customer->name . ' berhasil disimpan!'
            ]);
        } catch (\Exception $err) {
            return redirect()->back()->with(['error' => $err->getMessage()]);
        }
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required|max:13',
            'address' => 'required|string',
            'email' => 'required|email|string|exists:customers,email'
        ]);

        try {
            $customer = Customer::find($id);
            $customer->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address
            ]);
            return redirect('/customer')->with([
                'success' => 'Data ' . $request->name . ' berhasil diperbaharui!'
            ]);
        } catch (\Exception $err) {
            return redirect()->back()->with([
                'error' => $err->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->back()->with([
            'success' => '<strong>' . $customer->name . '</strong> berhasil dihapus!'
        ]);
    }
}
