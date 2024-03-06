<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    public function store(Request $request)
    {
        Customer::create($request->validate([
          'first_name' => 'required|string|min:2|max:20',
          'last_name' => 'required|min:3|max:20',
          'middle_name' => 'nullable|string',
          'email' => 'required|email',
          'phoneNumber' => 'required|string|min:12',
        ]));
    }
}
