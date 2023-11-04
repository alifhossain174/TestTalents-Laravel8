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
            font-size: 38px;
            margin-bottom: 10px;
            font-family: Helvetica, sans-serif;
            text-shadow: 5px 5px 5px rgb(61, 61, 61)
        }

        .heading p {
            font-family: Helvetica, sans-serif;
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
            padding-bottom: 8px;
            font-weight: 600;
            font-size: 15px;
            width: 80%;
            margin: auto;
            font-family: Helvetica, sans-serif;
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
            margin-bottom: 20px;
            margin-top: 20px;
            font-family: Helvetica, sans-serif;
            text-shadow: none;
            box-shadow: 5px 5px 5px gray;
            transition: all .2s linear;
            text-decoration: none;
        }

        .content a.assesment_button:hover{
            box-shadow: none;
            text-shadow: 5px 5px 5px rgb(61, 61, 61);
        }
    </style>
</head>

<body width="100%" style="margin: 0; padding: 0; mso-line-height-rule: exactly;">

    <table class="heading" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td>
                <h1>TestTalents</h1>
                <p class="text-white"><b>Take 1 minute to help</b></p>
            </td>
        </tr>
    </table>

    <table class="content" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td>
                {{-- <p style="text-align: left">Hi {{$testimonialInfo['referee_name']}}, </p>
                <p style="text-align: left">Your Client {{$testimonialInfo['candidate_name']}} is building a profile on TestTalents - Digital Talent Assessment Solution.</p> --}}

                <?php if($testimonialInfo['msg'] != ''){?>
                <p style="text-align: left; padding: 20px; background: #dfdfdf; margin-top: 20px; margin-bottom: 20px; font-family: 'Brush Script MT', cursive; font-weight: 400; line-height: 22px">
                    {{$testimonialInfo['msg']}}
                </p>
                <?php } ?>

                {{-- <p>You can help by sharing a brief testimonial for {{$testimonialInfo['candidate_name']}}’s profile.</p> --}}

                <a class="assesment_button" href="{{url('submit/testimonial')}}/{{$testimonialInfo['slug']}}/{{$testimonialInfo['candidate_slug']}}" target="_blank">Click Here to submit Testimonial</a>
                <p>
                    <span style="font-size: 12px">
                        If you experience any issues with the assessment, please contact us on support@testtalents.com
                    </span>
                </p>
                <p style="padding-bottom: 0px;">All the best,</p>
                <p style="padding-top: 0px;">TestTalents Team</p>
            </td>
        </tr>
    </table>
</body>

</html>
