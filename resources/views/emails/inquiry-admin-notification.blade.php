<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; background-color: #f1faf6; font-family: 'Segoe UI', Arial, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color: #f1faf6; padding: 32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width: 560px; background-color: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(15,61,50,0.08);">
                    <tr>
                        <td style="background: linear-gradient(135deg, #0b5f49 0%, #0f765a 100%); padding: 32px 40px; text-align: center;">
                            <span style="display: inline-block; font-size: 22px; font-weight: 700; color: #ffffff; letter-spacing: 0.3px;">
                                NeuroDigital Support
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px;">
                            <span style="display: inline-block; background-color: #fdf1e0; color: #a5661b; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; padding: 6px 14px; border-radius: 999px;">
                                New Submission
                            </span>

                            <h1 style="margin: 16px 0 0; font-size: 22px; line-height: 1.3; color: #0b3b31;">
                                {{ str_replace('_', ' ', ucfirst($inquiry->type)) }} received
                            </h1>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-top: 24px; border-collapse: collapse;">
                                @if($inquiry->name)
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #eef2f0; font-size: 13px; font-weight: 700; color: #7a8f88; width: 130px; vertical-align: top;">Name</td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #eef2f0; font-size: 14px; color: #102f28;">{{ $inquiry->name }}</td>
                                </tr>
                                @endif
                                @if($inquiry->email)
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #eef2f0; font-size: 13px; font-weight: 700; color: #7a8f88; vertical-align: top;">Email</td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #eef2f0; font-size: 14px; color: #102f28;">{{ $inquiry->email }}</td>
                                </tr>
                                @endif
                                @if($inquiry->subject)
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #eef2f0; font-size: 13px; font-weight: 700; color: #7a8f88; vertical-align: top;">Subject</td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #eef2f0; font-size: 14px; color: #102f28;">{{ $inquiry->subject }}</td>
                                </tr>
                                @endif
                                @if($inquiry->phone_number)
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #eef2f0; font-size: 13px; font-weight: 700; color: #7a8f88; vertical-align: top;">Phone</td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #eef2f0; font-size: 14px; color: #102f28;">{{ $inquiry->phone_number }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td style="padding: 10px 0; font-size: 13px; font-weight: 700; color: #7a8f88; vertical-align: top;">Preferred Response</td>
                                    <td style="padding: 10px 0; font-size: 14px; color: #102f28; text-transform: capitalize;">{{ $inquiry->response_method }}</td>
                                </tr>
                            </table>

                            @if($inquiry->message)
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-top: 20px; background-color: #f1faf6; border-radius: 14px;">
                                <tr>
                                    <td style="padding: 18px 20px;">
                                        <p style="margin: 0 0 8px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #0f765a;">Message</p>
                                        <p style="margin: 0; font-size: 14px; line-height: 1.6; color: #31544c; white-space: pre-line;">{{ $inquiry->message }}</p>
                                    </td>
                                </tr>
                            </table>
                            @endif

                            <p style="margin: 28px 0 0; font-size: 13px; color: #7a8f88;">
                                View and manage this submission from the admin dashboard.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="background-color: #fbfffd; border-top: 1px solid #e2f0ea; padding: 20px 40px; text-align: center;">
                            <p style="margin: 0; font-size: 13px; color: #7a8f88;">
                                &copy; {{ date('Y') }} NeuroDigital Support
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
