<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Krushi Marathi - Newsletter</title>
    <style type="text/css">
        body, #bodyTable {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        td {
            font-family: 'Segoe UI', sans-serif;
            font-size: 14px;
            color: #555555;
            line-height: 20px;
        }
        a {
            text-decoration: none;
            color: #276749;
        }
        img {
            border: 0;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }
        .container {
            width: 100%;
            max-width: 640px;
            margin: 0 auto;
        }
        .header {
            background-color: #276749;
            padding: 30px 20px;
            color: #ffffff;
        }
        .header h1 {
            font-size: 20px;
            margin: 10px 0 5px;
            color: #ffffff;
            line-height: 1.2;
        }
        .header p {
            font-size: 14px;
            margin: 0;
            color: #d0f0dd;
        }
        .content {
            padding: 20px;
            background: #ffffff;
        }
        .card {
            border: 1px solid #eeeeee;
            border-radius: 8px;
            overflow: hidden;
            background-color: #ffffff;
            margin-bottom: 20px;
        }
        .card-content {
            padding: 10px 15px;
        }
        .card-content h3 {
            margin: 0 0 10px;
            font-size: 17px;
            line-height: 1.3;
        }
        .card-content h3 a {
            color: #2d3748;
        }
        .card-content p {
            font-size: 14px;
            color: #555;
            margin: 0;
        }
        .footer {
            background: #f7fafc;
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #555;
        }
        .footer a {
            color: #276749;
            margin: 0 5px;
            text-decoration: none;
        }
        .footer-logo {
            margin-top: 10px;
        }
        .footer-logo img {
            height: 28px;
        }

        /* --- Responsive Fix for Mobile --- */
        @media screen and (max-width: 600px) {
            .container {
                width: 100% !important;
            }
            .card-table {
                width: 100% !important;
                display: block !important;
            }
            .card-image-cell, .card-content-cell {
                width: 100% !important;
                display: block !important;
            }
            .card-image-cell img {
                width: 100% !important;
                height: auto !important;
                display: block !important; /* This is the key change */
            }
            .header h1 {
                font-size: 18px !important;
            }
            .card-content h3 {
                font-size: 16px !important;
            }
            .card-content-cell {
                padding: 15px !important;
            }
        }
    </style>
    </head>
<body style="margin:0; padding:0; background-color:#f4f4f4;">

<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
        <td align="center" style="padding: 0 10px;">
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" class="container" style="max-width:640px; margin:0 auto; background-color:#ffffff; border-radius:8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
                <tr>
                    <td class="header" align="center" style="background-color: #276749; padding: 30px 20px; color: #ffffff;">
                        <img src="{{ asset('public/footer_logo.png') }}" alt="Krushi Marathi" style="height: 60px; margin-bottom: 10px; border:none;">
                        <h1 style="font-size: 20px; margin: 10px 0 5px; color: #ffffff; line-height: 1.2;">Krushi Marathi - Daily Newsletter</h1>
                        <p style="font-size: 14px; margin: 0; color: #d0f0dd;">Your Trusted Source for Agricultural News, Prices & Updates</p>
                    </td>
                </tr>

                <tr>
                    <td class="content" style="padding: 20px;">
                        @foreach ($blogs as $blog)
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" class="card" style="margin-bottom: 20px; border: 1px solid #eeeeee; border-radius: 8px; background-color: #ffffff;">
                            <tr>
                                <td style="padding: 0;">
                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tr>
                                            <td class="card-image-cell" valign="top" align="center" width="220" style="padding: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                <a href="{{ route('blog.view', ['blog_slug' => $blog->blog_slug]) }}" target="_blank">
                                                    <img src="{{ $blog->blog_image ?? asset('default-image.jpg') }}" alt="{{ $blog->blog_title }}" width="220" style="width: 220px; height: auto; display: block; border: none; font-size: 14px; color: #333333;">
                                                </a>
                                            </td>
                                            <td class="card-content-cell" valign="top" style="padding: 0px 15px; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                <h3 style="margin: 0 0 10px; font-size: 17px; line-height: 1.3;">
                                                    <a href="{{ route('blog.view', ['blog_slug' => $blog->blog_slug]) }}" target="_blank" style="text-decoration: none; color: #2d3748;">
                                                        {{ $blog->blog_title }}
                                                    </a>
                                                </h3>
                                                <p style="font-size: 14px; color: #555; margin: 0;">{{ \Illuminate\Support\Str::limit(strip_tags($blog->meta_description), 120) }}</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        @endforeach
                    </td>
                </tr>

                <tr>
                    <td class="footer" align="center" style="background: #f7fafc; padding: 20px; font-size: 13px; color: #555;">
                        <p style="margin: 0 0 10px;">Thank you for reading. Stay connected with <strong style="color:#276749;">Krushi Marathi</strong>.</p>
                        <p style="margin: 0;">
                            <a href="{{ url('/') }}" style="color: #276749; margin: 0 5px;">Home</a> |
                            <a href="{{ url('/aboutus') }}" style="color: #276749; margin: 0 5px;">About Us</a> |
                            <a href="{{ url('/contact-us') }}" style="color: #276749; margin: 0 5px;">Contact</a> |
                            <a href="{{ url('/privacy-policy') }}" style="color: #276749; margin: 0 5px;">Privacy Policy</a>
                        </p>
                        <div class="footer-logo" style="margin-top: 10px;">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('public/logo.png') }}" alt="Krushi Marathi" style="height: 28px; border:none;">
                            </a>
                        </div>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>