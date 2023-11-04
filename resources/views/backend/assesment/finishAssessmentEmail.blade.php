<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TestTalents</title>
    <style>
        .heading{
            width: 100%;
            text-align: center;
            background: #226679;
            color: white;
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .heading h1{
            font-size: 40px
        }
        .content{
            width: 100%;
            padding-top: 40px;
            padding-bottom: 40px;
            color: black;
            text-align: center;
        }
        .content p{
            padding-top: 10px;
            padding-bottom: 10px;
            font-weight: 600;
            font-size: 15px;
            text-align: left;
        }
        .content a.assesment_button{
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
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="heading">
        <h1>TestTalents</h1>
    </div>
    <div class="content">
        <p><b>Hi {{$sendAssessmentInfo['assessment_creator_name']}} ,</b></p>
        <p>Your invited candidate {{$sendAssessmentInfo['candidate_name']}} has completed the test. <br> Hence, you will be able to view the grades and test reports. </p>
        <p>Go to your dashboard to pick up where you left off.</p>
        <a class="assesment_button" href="{{url('/home')}}">Go To Dashboard</a>
        <p style="width: 80%;margin:auto;text-align:center">
            <span style="font-size: 12px">If you experience any issues with the assessment, please contact us on support@testtalents.com</span>
        </p>
        <p style="padding-bottom: 0px;"><b>Thanks </b><br><b>The TestTalents Team</b></p>
    </div>
</body>
</html>
