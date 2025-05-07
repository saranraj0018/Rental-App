<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
</head>
<body>

    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td align="left" style="padding: 24px 0;">
                            <strong>Valamcars</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Hello {{ $user->name ?? 'User' }},</p>

                            <p>You recently requested to reset your password for your Valamcars account. Click the link below to reset it.</p>

                            <p><a href="{{ $resetUrl }}">Reset your password</a></p>

                            <p>If you did not request a password reset, please ignore this email or contact support if you have questions.</p>

                            <p>This password reset link will expire in 60 minutes.</p>

                            <p>Thanks,<br>The Valamcars Team</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 40px; font-size: 12px; color: #666;">
                            <p>© {{ date('Y') }} Valamcars. All rights reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
