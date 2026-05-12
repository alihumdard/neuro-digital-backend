<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InquiryController extends Controller
{
    public function inquiryStore(Request $request)
    {
        // validation
        $request->validate([
            'name' => 'nullable|string | max:255',
            'email' => 'nullable|email|required_if:response_method,email',
            
            'subject' => 'required|string',
             'message' => 'nullable|    ',
            'response_method' => [
                'required',
                Rule::in(['email', 'phone']),
            ],
            'phone_number' => [
                'nullable',
                'required_if:response_method,phone',
                'string',
                'max:20',
            ]
        ]);

        Inquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'response_method' => $request->response_method,
            'phone_number' => $request->phone_number
        ]);

        return response()->json([
            "message" => "Your inquiry submited successfully"
        ]);
    }
}
