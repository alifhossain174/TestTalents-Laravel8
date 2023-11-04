<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
    <title>TestTalents</title>
    <style>
        table {
            border-collapse: separate;
        }

        a,
        a:link,
        a:visited {
            text-decoration: none;
            color: #00788a;
        }

        a:hover {
            text-decoration: underline;
        }

        h2,
        h2 a,
        h2 a:visited,
        h3,
        h3 a,
        h3 a:visited,
        h4,
        h5,
        h6,
        .t_cht {
            color: #000 !important;
        }

        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td {
            line-height: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        .heading {
            width: 100%;
            text-align: center;
            background: #226679;
            color: white;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .heading h1 {
            font-size: 40px
        }

        .content {
            width: 100%;
            padding-top: 40px;
            padding-bottom: 40px;
            color: black;
            text-align: center;
        }

        .content p {
            padding-top: 10px;
            padding-bottom: 10px;
            font-weight: 600;
            font-size: 15px;
            text-align: center;
            width: 80%;
            margin: auto;
        }

        .content a.assesment_button {
            display: inline-block;
            padding-top: 15px;
            padding-bottom: 15px;
            padding-left: 40px;
            padding-right: 40px;
            background: #226679;
            color: white;
            font-weight: 600;
            font-size: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body width="100%" style="margin: 0; padding: 0; mso-line-height-rule: exactly;">

    <table class="heading" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td>
                <h1>TestTalents</h1>
            </td>
        </tr>
    </table>

    <table class="content" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td>
                <p><b>Dear Candidate,</b></p>
                <p>I hope this email finds you well. I am reaching out on behalf of {{$sendLinkInfo['company_name']}} to invite you to complete a TestTalents Assessment.</p>
                <p>{{$sendLinkInfo['message']}}</p>
                <p>To begin the assessment, simply click the button below:</p>
                <a class="assesment_button" href="{{url('/take/assesment')}}/{{$sendLinkInfo['assesment_slug']}}/{{$sendLinkInfo['email']}}/{{$sendLinkInfo['slug']}}">
                    Go To Assesment
                </a>
                <p>
                    <span style="font-size: 12px">Please note that you can only click the assessment URL a maximum of two times. After that, the assessment will be automatically blocked for you.</span>
                </p>
                <p>
                    In case the above link doesn't work, you can copy and paste the following URL into your web browser: <br> <span style="color:#226679 !important">{{url('/take/assesment')}}/{{$sendLinkInfo['assesment_slug']}}/{{$sendLinkInfo['email']}}/{{$sendLinkInfo['slug']}}</span>
                </p>
                <p>
                    <span style="font-size: 12px">
                        Should you encounter any issues or require assistance during the assessment, please don't hesitate to reach out to us at support@testtalents.com
                    </span>
                </p>
                <p>Thank you for your participation, and we look forward to reviewing your assessment.</p>
                <br>
                <p style="padding: 0px;">Best regards,</p>
                <p style="padding: 0px;">{{Auth::user()->name}},</p>
                <p style="padding: 0px;">{{$sendLinkInfo['company_name']}}</p>
            </td>
        </tr>
    </table>
</body>

</html>
