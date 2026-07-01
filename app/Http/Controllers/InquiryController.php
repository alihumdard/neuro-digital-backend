<?php

namespace App\Http\Controllers;

use App\Mail\InquiryAdminNotification;
use App\Mail\InquiryUserConfirmation;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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

        $inquiry = Inquiry::create([
            'type' => 'contact',
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'response_method' => $request->response_method,
            'phone_number' => $request->phone_number
        ]);

        $this->sendInquiryEmails($inquiry);

        return response()->json([
            "message" => "Your inquiry submited successfully"
        ]);
    }

    public function newsletterStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $inquiry = Inquiry::create([
            'type' => 'newsletter',
            'email' => $request->email,
            'subject' => 'Newsletter subscription',
            'response_method' => 'email',
        ]);

        $this->sendInquiryEmails($inquiry);

        return response()->json([
            'message' => 'Thanks for subscribing.',
        ]);
    }

    public function getStartedStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'nullable|string',
        ]);

        $inquiry = Inquiry::create([
            'type' => 'get_started',
            'name' => $request->name,
            'email' => $request->email,
            'subject' => 'Get started request',
            'message' => $request->message,
            'response_method' => 'email',
        ]);

        $this->sendInquiryEmails($inquiry);

        return response()->json([
            'message' => 'Thanks, we will be in touch shortly.',
        ]);
    }

    private function sendInquiryEmails(Inquiry $inquiry): void
    {
        $adminEmail = config('mail.admin_notification_address');

        try {
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new InquiryAdminNotification($inquiry));
            }

            if ($inquiry->email) {
                Mail::to($inquiry->email)->send(new InquiryUserConfirmation($inquiry));
            }
        } catch (\Throwable $exception) {
            // Do not fail the request if email delivery fails; the inquiry is already saved.
            Log::error('Failed to send inquiry emails: ' . $exception->getMessage());
        }
    }

    public function index(Request $request)
    {
        $inquiries = Inquiry::query()
            ->when($request->query('type'), fn ($query, $type) => $query->where('type', $type))
            ->when($request->query('status'), fn ($query, $status) => $query->where('status', $status))
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Inquiries fetched successfully',
            'data' => $inquiries,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => ['nullable', Rule::in(['new', 'replied'])],
            'admin_note' => 'nullable|string',
        ]);

        $inquiry = Inquiry::findOrFail($id);
        $inquiry->update($request->only(['status', 'admin_note']));

        return response()->json([
            'message' => 'Inquiry updated successfully',
            'data' => $inquiry,
        ]);
    }

    public function destroy($id)
    {
        Inquiry::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Inquiry deleted successfully',
        ]);
    }
}
