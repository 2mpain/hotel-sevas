<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Customer;

class CustomersController extends Controller
{
    public function store(Request $request)
    {
        \Log::info('creating');
        Customer::create($request->validate([
          'first_name' => ['required'],
          'last_name' => ['required'],
          'middle_name' => ['required'],
          'email' => ['required'],
          'phoneNumber' => ['required'],
        ]));
        \Log::info('created');
       

        return redirect()->back();
    }
}
