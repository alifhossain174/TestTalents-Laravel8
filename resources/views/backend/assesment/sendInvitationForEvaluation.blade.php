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
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .heading h1 {
            font-size: 30px
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
                <p><b>Hey there,</b></p>
                <p>You are invited to evaluate a TestTalents Assessment.</p>
                <p>
                    You can evalute the assessment by login to our user panel. Your account credentials have mentioned below :<br>
                    Login Email: {{$sendLinkInfo['email']}} <br>
                    Login Password: @if($sendLinkInfo['password'] == '') You already have an account @else {{$sendLinkInfo['password']}} @endif
                </p>

                <a class="assesment_button" href="{{url('/see/candidates')}}/{{$sendLinkInfo['assessment_slug']}}">Login to Evaluate</a>

                <p>
                    <span style="font-size: 12px">If you experience any issues with the assessment, please contact us on administrator@testtalents.com </span>
                </p>
                <p style="padding-bottom: 0px;"><b>All the best, </b></p>
                <p style="padding-top: 5px;"><b>TestTalents Team</b></p>
            </td>
        </tr>
    </table>
</body>

</html>
