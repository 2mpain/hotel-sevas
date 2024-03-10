<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbacksController extends Controller
{

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:20',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        try {
            $customer = Customer::where('email', $request->email)->first();
            \Log::info($customer);

            $customerId = $customer ? $customer->id : null;

            Feedback::create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'customer_id' => $customerId,
            ]);

            if ($customer) {
                $customer->increment('feedbacks_count');
            }

            return redirect()->back()->with('success');
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect()->back()->with('error', 'Что-то пошло не так');
        }
    }
}
