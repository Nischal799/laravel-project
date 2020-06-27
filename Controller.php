<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index(Request $request)
    {
        dd($request->query('active'));
        $customers = Customer::where('active',1)->get();

        return view('customer.index',compact('customers'));
    }

    public function create()
    {
        $customer =new Customer();

        return view('customer.create',compact('customer'));
    }

    public function store()
    {
        $customer = Customer::create($this->validatedData());
        return redirect('/customers/' . $customer->id);
    }

    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    public function update(Customer $customer)
    {
        $customer->update($this->validatedData());

        return redirect('/customers');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect('/customers');
    }

    protected function validateddata()
    {
        return request()->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);
    }
}
