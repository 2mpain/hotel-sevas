<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    /**
     * @param Request $request
     * 
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|min:2|max:20',
            'last_name' => 'required|min:3|max:20',
            'middle_name' => 'nullable|string',
            'email' => 'required|email',
            'phoneNumber' => 'required|string|min:12',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        try {
            Customer::create($request->all());
            return redirect()->back()->with('success');
        } catch (\Exception $e) {
            \Log::info($e);
        }
    }
}
