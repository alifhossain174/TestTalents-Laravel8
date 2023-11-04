@extends('backend.client.master')

@section('header_css')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('frontend_assets') }}/css/toastr.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Roboto', sans-serif !important;
        }

        .container-fluid {
            width: 90%
        }

        ul {
            padding-left: 16px;
            margin-top: 20px
        }

        ul li {
            list-style: square;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px
        }

    </style>
@endsection

@section('content')
    <!-- question content start-->
    <section>
        <div class="single_assesment_content mb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="assesment_details bg-white" style="margin-top: 75px">
                            <div class="row">
                                <div class="col-lg-5 border-right pt-5">
                                    <h3 class="mb-3">Hello !</h3>
                                    <p class="mb-3">
                                        @if($assesment_info->company_name != '')
                                        Thank you for applying at {{$assesment_info->company_name}}. You are welcome to TestTalents assessment.
                                        @else
                                        Welcome to TestTalents assessment.
                                        @endif
                                    </p>
                                    <p class="mb-3">Completing it will give you a chance to show off your skills
                                        and stand out from the crowd!</p>
                                    <p class="mb-3 mt-3"><b>Good luck!</b></p>

                                    <input type="hidden" name="webcam" id="image-tag">
                                    <div id="my_camera" style="display:none"></div>

                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <form action="{{ url('get/started') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="assesment_slug" value="{{ $assesment_info->slug }}">
                                                <input type="hidden" value="{{ $client_email }}" name="client_email">
                                                <input type="hidden" value="{{ $candidateSlug }}" name="candidate_slug">

                                                <br>
                                                <label class="d-block text-left"><b>Write Your Full Name: </b></label>
                                                <input type="text" class="form-control" name="candidate_name" placeholder="Name" required>
                                                <input type="submit" value="Get Started" style="background: #1D4354" class="btn mt-4 pl-5 pr-5 font-weight-bolder text-white">

                                                <?php
                                                    $device_used = '';
                                                    $isMob = is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile'));
                                                    $isMob == true ? ($device_used = 'Mobile') : ($device_used = 'Desktop');
                                                ?>

                                                <?php
                                                    $os_used = '';
                                                    function getOS()
                                                    {
                                                        $user_agent = $_SERVER['HTTP_USER_AGENT'];
                                                        $os_platform = 'Bilinmeyen İşletim Sistemi';
                                                        $os_array = [
                                                            '/windows nt 10/i' => 'Windows 10',
                                                            '/windows nt 6.3/i' => 'Windows 8.1',
                                                            '/windows nt 6.2/i' => 'Windows 8',
                                                            '/windows nt 6.1/i' => 'Windows 7',
                                                            '/windows nt 6.0/i' => 'Windows Vista',
                                                            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
                                                            '/windows nt 5.1/i' => 'Windows XP',
                                                            '/windows xp/i' => 'Windows XP',
                                                            '/windows nt 5.0/i' => 'Windows 2000',
                                                            '/windows me/i' => 'Windows ME',
                                                            '/win98/i' => 'Windows 98',
                                                            '/win95/i' => 'Windows 95',
                                                            '/win16/i' => 'Windows 3.11',
                                                            '/macintosh|mac os x/i' => 'Mac OS X',
                                                            '/mac_powerpc/i' => 'Mac OS 9',
                                                            '/linux/i' => 'Linux',
                                                            '/ubuntu/i' => 'Ubuntu',
                                                            '/iphone/i' => 'iPhone',
                                                            '/ipod/i' => 'iPod',
                                                            '/ipad/i' => 'iPad',
                                                            '/android/i' => 'Android',
                                                            '/blackberry/i' => 'BlackBerry',
                                                            '/webos/i' => 'Mobile',
                                                        ];

                                                        foreach ($os_array as $regex => $value) {
                                                            if (preg_match($regex, $user_agent)) {
                                                                $os_platform = $value;
                                                            }
                                                        }
                                                        return $os_platform;
                                                    }

                                                    $browser_used = '';
                                                    function getBrowser()
                                                    {
                                                        $user_agent = $_SERVER['HTTP_USER_AGENT'];

                                                        $browser = 'Bilinmeyen Tarayıcı';
                                                        $browser_array = [
                                                            '/msie/i' => 'Internet Explorer',
                                                            '/firefox/i' => 'Firefox',
                                                            '/safari/i' => 'Safari',
                                                            '/chrome/i' => 'Chrome',
                                                            '/edge/i' => 'Edge',
                                                            '/opera/i' => 'Opera',
                                                            '/netscape/i' => 'Netscape',
                                                            '/maxthon/i' => 'Maxthon',
                                                            '/konqueror/i' => 'Konqueror',
                                                            '/mobile/i' => 'Handheld Browser',
                                                        ];

                                                        foreach ($browser_array as $regex => $value) {
                                                            if (preg_match($regex, $user_agent)) {
                                                                $browser = $value;
                                                            }
                                                        }
                                                        return $browser;
                                                    }

                                                    $os_used = getOS();
                                                    $browser_used = getBrowser();
                                                ?>

                                                <?php
                                                $location = '';
                                                $ipaddress = '';
                                                if (isset($_SERVER['HTTP_CLIENT_IP'])) {
                                                    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                                                } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                                    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                                } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
                                                    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                                                } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
                                                    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                                                } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
                                                    $ipaddress = $_SERVER['HTTP_FORWARDED'];
                                                } elseif (isset($_SERVER['REMOTE_ADDR'])) {
                                                    $ipaddress = $_SERVER['REMOTE_ADDR'];
                                                } else {
                                                    $ipaddress = 'UNKNOWN';
                                                }

                                                try {
                                                    // $url = "http://api.ipstack.com/$ipaddress?access_key=367111113a98b3b943111b0d584809f8&format=1";
                                                    $url = "http://api.ipstack.com/$ipaddress?access_key=fbd060ffbb02d4f312f26a946a205e2f&format=1";
                                                    $ch = curl_init();
                                                    curl_setopt($ch, CURLOPT_URL, $url);
                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                                                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                                                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                                    $response = curl_exec($ch);
                                                    curl_close($ch);
                                                    $response = json_decode($response);
                                                    if ($response->city != '') {
                                                        $location = $response->city . ', ' . $response->region_name . ', ' . $response->country_name;
                                                    }
                                                } catch (\Exception $e) {
                                                    $location = 'Location API Not Working';
                                                }

                                                ?>

                                                <input type="hidden" value="{{ $device_used }}" name="device_used">
                                                <input type="hidden" value="{{ $os_used }}" name="os_used">
                                                <input type="hidden" value="{{ $browser_used }}" name="browser_used">
                                                <input type="hidden" value="{{ $location }}" name="location">
                                                <input type="hidden" value="{{ $ipaddress }}" name="ip_address">

                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">

                                    <h5><b>Before you begin the assessment, here are some important points to note :</b></h5>
                                    <ul>
                                        <li>
                                            This assessment consists of
                                            <span style="color: #008f37">{{ $assesment_tests_count }}</span> test and
                                            <span style="color: #008f37">{{ $assesment_questions_count }}</span> individual question and is expected to take approximately
                                            <span style="color: #008f37">{{ $assesment_info->total_mins }}</span> minutes to complete.
                                        </li>
                                        <li>
                                            You will be allowed to access the assessment URL a maximum of
                                            <span style="color: #008f37">2</span> times. After that, you will be automatically banned from accessing it again.
                                        </li>
                                        <li>The assessment is timed, and you will see a timer for each test or question.</li>
                                        <li>
                                            <span style="color: #008f37">Please ensure that you enable your camera/webcam </span>
                                            and stay in full-screen mode during the assessment. Periodic snapshots will be taken to ensure fairness for all candidates.
                                        </li>
                                        <li>Make sure to turn on your <span style="color: #008f37">speakers or headphones</span> as there might be audio content.</li>
                                        <li>You are allowed to use a <span style="color: #008f37">calculator, pen, and paper</span> during the assessment.</li>
                                        <li>It is recommended to complete the assessment in one go without reloading the page.</li>
                                        <li><span style="color: #008f37">Keep in mind</span> that you won't be able to see the previous question while attempting the current one.</li>
                                        <li><span style="color: #008f37">Please follow</span> these instructions carefully while attending the exam.</li>
                                    </ul>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- question content end-->
@endsection


@section('footer_js')

    <script src="{{ url('recordAudioJS') }}/recorder.js"></script>
    <script src="{{ url('webcamCaptureJS') }}/webcam.js"></script>

    <script>
        var microphonePermission = true;
        startRecording();
        stopRecording();

        function startRecording() {
            var constraints = {
                audio: true,
                video: false
            }
            navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
                audioContext = new AudioContext();
                gumStream = stream;
                input = audioContext.createMediaStreamSource(stream);
                rec = new Recorder(input, {
                    numChannels: 1
                })
                rec.record()
            }).catch(function(err) {
                toastr.error("Audio Recording Is Not Working")
                microphonePermission = false;
            });
        }

        function stopRecording() {
            if (microphonePermission == true) {
                rec.stop();
                gumStream.getAudioTracks()[0].stop();
                rec.exportWAV(createDownloadLink);
            }
        }

        function createDownloadLink(blob) {
            var d = new Date();
            var n = d.getTime();
            var filename = n + Math.floor(Math.random() * 10000000001);
            var formData = new FormData();
            formData.append("audio_data", blob, filename);
        }
    </script>

    <script>
        Webcam.set({
            width: 490,
            height: 390,
            image_format: 'jpeg',
            jpeg_quality: 100
        });

        Webcam.attach('#my_camera');
        Webcam.snap(function(data_uri) {
            $("#image-tag").val(data_uri);
        });
    </script>


    <script>
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function() {
            window.history.pushState(null, "", window.location.href);
        };

        // take body to change the content
        const body = document.getElementsByTagName('body');
        // stop keyboard shortcuts
        window.addEventListener("keydown", (event) => {
            if (event.ctrlKey && (event.key === "S" || event.key === "s")) {
                event.preventDefault();
            }
            if (event.ctrlKey && (event.key === "C")) {
                event.preventDefault();
            }
            if (event.ctrlKey && (event.key === "E" || event.key === "e")) {
                event.preventDefault();
            }
            if (event.ctrlKey && (event.key === "I" || event.key === "i")) {
                event.preventDefault();
            }
            if (event.ctrlKey && (event.key === "K" || event.key === "k")) {
                event.preventDefault();
            }
            if (event.ctrlKey && (event.key === "U" || event.key === "u")) {
                event.preventDefault();
            }
            if (event.key === "F12") {
                event.preventDefault();
            }
        });
        // stop right click
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });
    </script>

    <script src="{{ url('frontend_assets') }}/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
@endsection
