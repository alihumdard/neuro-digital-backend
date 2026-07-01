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
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding-bottom: 8px;">
                                        <span style="display: inline-block; background-color: #e8f7f1; color: #0f765a; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; padding: 6px 14px; border-radius: 999px;">
                                            Message Received
                                        </span>
                                    </td>
                                </tr>
                            </table>

                            <h1 style="margin: 16px 0 0; font-size: 24px; line-height: 1.3; color: #0b3b31;">
                                Thank you for reaching out
                            </h1>

                            <p style="margin: 20px 0 0; font-size: 15px; line-height: 1.7; color: #31544c;">
                                Hi{{ $inquiry->name ? ' ' . $inquiry->name : '' }},
                            </p>

                            <p style="margin: 12px 0 0; font-size: 15px; line-height: 1.7; color: #31544c;">
                                We have received your
                                @if($inquiry->type === 'newsletter')
                                    newsletter subscription
                                @elseif($inquiry->type === 'get_started')
                                    request to get started
                                @else
                                    message
                                @endif
                                and our team will be in touch as soon as possible.
                            </p>

                            @if($inquiry->message)
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-top: 24px; background-color: #f1faf6; border-radius: 14px;">
                                <tr>
                                    <td style="padding: 18px 20px;">
                                        <p style="margin: 0 0 8px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #0f765a;">
                                            Your message
                                        </p>
                                        <p style="margin: 0; font-size: 14px; line-height: 1.6; color: #31544c; white-space: pre-line;">{{ $inquiry->message }}</p>
                                    </td>
                                </tr>
                            </table>
                            @endif

                            <p style="margin: 28px 0 0; font-size: 15px; line-height: 1.7; color: #31544c;">
                                Warm regards,<br>
                                <strong style="color: #0b3b31;">The NeuroDigital Support Team</strong>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="background-color: #fbfffd; border-top: 1px solid #e2f0ea; padding: 24px 40px; text-align: center;">
                            <p style="margin: 0; font-size: 13px; color: #7a8f88;">
                                &copy; {{ date('Y') }} NeuroDigital Support. All rights reserved.
                            </p>
                            <p style="margin: 6px 0 0; font-size: 13px;">
                                <a href="mailto:info@neurodigitalsupport.com" style="color: #0f765a; text-decoration: none;">info@neurodigitalsupport.com</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
