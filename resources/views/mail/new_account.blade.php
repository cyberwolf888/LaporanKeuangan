<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title>New Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation-emails/2.2.1/foundation-emails.min.css">
</head>

<body>
<!-- <style> -->
<table class="body" data-made-with-foundation="">
    <tr>
        <td class="float-center" align="center" valign="top">
            <center data-parsed="">
                <style type="text/css" align="center" class="float-center">
                    body,
                    html,
                    .body {
                        background: #f3f3f3 !important;
                    }

                    .container.header {
                        background: #f3f3f3;
                    }

                    .body-drip {
                        border-top: 8px solid #49a7fa;
                    }
                </style>
                <table align="center" class="container header float-center">
                    <tbody>
                    <tr>
                        <td>
                            <table class="row collapse">
                                <tbody>
                                <tr>
                                    <th class="small-12 large-12 columns first last">
                                        <table>
                                            <tr>
                                                <th>  </th>
                                                <th class="expander"></th>
                                            </tr>
                                        </table>
                                    </th>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table align="center" class="container body-drip float-center">
                    <tbody>
                    <tr>
                        <td>
                            <table class="spacer">
                                <tbody>
                                <tr>
                                    <td height="16px" style="font-size:16px;line-height:16px;">&#xA0;</td>
                                </tr>
                                </tbody>
                            </table>
                            <center data-parsed=""> <img src="https://res.cloudinary.com/awesome888/image/upload/v1467472633/logo1_h0n8sz.png" alt="" align="center" class="float-center"> </center>
                            <table class="spacer">
                                <tbody>
                                <tr>
                                    <td height="16px" style="font-size:16px;line-height:16px;">&#xA0;</td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="row">
                                <tbody>
                                <tr>
                                    <th class="small-12 large-12 columns first last">
                                        <table>
                                            <tr>
                                                <th>
                                                    <h5 class="text-center">New Account</h5>
                                                    <p class="text-center">{{ $nama_lengkap }}</p>
                                                </th>
                                                <th class="expander"></th>
                                            </tr>
                                        </table>
                                    </th>
                                </tr>
                                </tbody>
                            </table>
                            <hr>
                            <table class="row">
                                <tbody>
                                <tr>
                                    <th class="small-12 large-12 columns first last">
                                        <table>
                                            <tr>
                                                <th>
                                                    <p>Dear Bapak/Ibu {{ $nama_lengkap }},</p>
                                                    <p style="text-align: justify;">Account baru anda telah selesai dibuat, dibawah ini merupakan detail account anda. Harap simpan dengan aman dan jangan beritahu orang lain password anda.</p>
                                                    <table border="0">
                                                        <tr>
                                                            <td>Email / Username</td>
                                                            <td>:</td>
                                                            <td><b>{{  $username }}</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Password</td>
                                                            <td>:</td>
                                                            <td><b>{{  $password }}</b></td>
                                                        </tr>
                                                    </table>
                                                    <p>&nbsp;</p>
                                                    <center data-parsed="">
                                                        <table class="button success float-center">
                                                            <tr>
                                                                <td>
                                                                    <table>
                                                                        <tr>
                                                                            <td><a href="{{ url('/login') }}">Login Now!</a></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </center>
                                                </th>
                                                <th class="expander"></th>
                                            </tr>
                                        </table>
                                    </th>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </center>
        </td>
    </tr>
</table>
</body>

</html>