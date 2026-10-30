<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f6f8; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f4f6f8; padding: 40px 10px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #2563eb; padding: 32px 40px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 700; letter-spacing: -0.5px;">InnovShop</h1>
                        </td>
                    </tr>

                    <!-- Main Body -->
                    <tr>
                        <td style="padding: 40px;">
                            <p style="margin: 0 0 24px 0; color: #475569; font-size: 15px; line-height: 1.6;">
                                Hello {{ $order->user->name }},
                            </p>
                            <h2 style="margin: 0 0 16px 0; color: #1e293b; font-size: 20px; font-weight: 600;">Thank you for your order!</h2>
                            <p style="margin: 0 0 24px 0; color: #475569; font-size: 15px; line-height: 1.6;">
                                We've received your order and are currently getting it ready. Here are your transaction details:
                            </p>

                            <!-- Order Summary Box -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 24px;">
                                <tr>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; color: #64748b; font-size: 14px;">
                                        Transaction ID
                                    </td>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; color: #0f172a; font-size: 14px; font-weight: 600; text-align: right;">
                                        {{ $order->transaction_id }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 16px 20px; color: #64748b; font-size: 14px;">
                                        Total Amount
                                    </td>
                                    <td style="padding: 16px 20px; color: #2563eb; font-size: 18px; font-weight: 700; text-align: right;">
                                        €{{ $order->total_amount }}
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 0 0 32px 0; color: #475569; font-size: 15px; line-height: 1.6;">
                                We will send you another email with tracking information as soon as your items ship.
                            </p>

                            <p style="margin: 0; color: #64748b; font-size: 14px;">
                                Cordially,<br>
                                <strong style="color: #0f172a;">The InnovShop Team</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 20px 40px; text-align: center; border-top: 1px solid #e2e8f0;">
                            <p style="margin: 0; color: #94a3b8; font-size: 12px;">
                                &copy; {{ date('Y') }} InnovShop. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>