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

        ul {
            list-style-type: none;
            padding-left: 0px;
        }

        table.heading {
            width: 100%;
            background: #226679;
        }

        table.heading tr td {
            text-align: center;
            color: white;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .heading h1 {
            font-size: 40px
        }

        table.content {
            width: 100%;
        }

        table.content tr td {
            padding-top: 30px;
            padding-bottom: 30px;
            padding-left: 20px;
            padding-right: 20px;
            color: black;
        }

        table.order_details {
            width: 100%;
            margin-bottom: 40px;
        }

        table.order_details tr td {
            padding-top: 0px;
            padding-bottom: 0px;
            padding-left: 0px;
            padding-right: 0px;
        }

        table.order_details tr td.label {
            text-align: left;
            width: 20%;
            font-weight: 600
        }

        table.order_details tr td.data {
            text-align: left;
        }

        table.package {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table.package tr th {
            background-color: #226679;
            color: white;
            font-weight: 400;
            padding-top: 3px;
            padding-bottom: 3px;
        }

        table.package tr td {
            padding-top: 3px;
            padding-bottom: 3px;
            padding-left: 10px;
            padding-right: 10px;
            text-align: center;
        }
    </style>
</head>

<body width="100%" style="margin: 0; padding: 0;">

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
                <b>Dear {{$paymentDetails['name']}},</b>
                <p>Thank you for choosing TestTalents. Your payment request has been received. Here's a summary of your payment details : </p>
                <br>
                <p><b><u>Order Details :</u></b></p>
                <table class="order_details">
                    <tr>
                        <td class="label">Payment Date:</td>
                        <td class="data">{{$paymentDetails['created_at']}}</td>
                        <td class="label">Payment Source:</td>
                        <td class="data">Online Payment</td>
                    </tr>
                    <tr>
                        <td class="label">Payment No:</td>
                        <td class="data">
                            @php
                                $number = $paymentDetails['id'];
                                echo str_pad($number, 4, '0', STR_PAD_LEFT);
                            @endphp
                        </td>
                        <td class="label">Initial Charge:</td>
                        <td class="data">BDT {{$paymentDetails['recharge_amount']}}</td>
                    </tr>
                    <tr>
                        <td class="label">Transaction ID:</td>
                        <td class="data">{{$paymentDetails['transaction_id']}}</td>
                        <td class="label">Final Cost: </td>
                        <td class="data">BDT {{$paymentDetails['recharge_amount']}}</td>
                    </tr>
                    <tr>
                        <td class="label">User Name:</td>
                        <td class="data">{{$paymentDetails['name']}}</td>
                        <td class="label">VAT: </td>
                        <td class="data">BDT 0</td>
                    </tr>
                    <tr>
                        <td class="label">User No:</td>
                        <td class="data">{{$paymentDetails['user_no']}}</td>
                        <td class="label">TAX: </td>
                        <td class="data">BDT 0</td>
                    </tr>
                    <tr>
                        <td class="label">Agent No:</td>
                        <td class="data">{{$paymentDetails['agent_no']}}</td>
                        <td class="label">Dicsount: </td>
                        <td class="data">BDT 0</td>
                    </tr>
                </table>

                <table class="package" border="2">
                    <tr>
                        <th style="width: 30%;">Package Name</th>
                        <th style="width: 15%;">Validity</th>
                        <th style="width: 15%;">QTY</th>
                        <th style="width: 20%;">Price</th>
                        <th style="width: 20%;">Sub-Total</th>
                    </tr>
                    <tr>
                        <td>
                            @php
                                if($paymentDetails['recharge_amount'] == 5000){
                                    echo "Basic Package";
                                }
                                elseif($paymentDetails['recharge_amount'] == 30000){
                                    echo "Premium Package";
                                }
                                elseif($paymentDetails['recharge_amount'] == 150000){
                                    echo "Business Package";
                                }
                                else{
                                    echo "Custom Package";
                                }
                            @endphp
                        </td>
                        <td>1 Year</td>
                        <td>1</td>
                        <td style="text-align: right;">{{$paymentDetails['recharge_amount']}} BDT</td>
                        <td style="text-align: right;">{{$paymentDetails['recharge_amount']}} BDT</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right;"><b>SubTotal : </b></td>
                        <td style="text-align: right;">{{$paymentDetails['recharge_amount']}} BDT</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right;"><b>Total : </b></td>
                        <td style="text-align: right;">{{$paymentDetails['recharge_amount']}} BDT</td>
                    </tr>
                </table>

                <p><b><u>Terms & Conditions</u></b></p>
                <ul>
                    <li>1 Payment Cannot be Refunded.</li>
                </ul>
                <p>Feel fee to email us at support@testtalents.com regarding any question or concern. Our support team is always ready to help you.</p>
                <br>
                <p><b>Regards,</b></p>
                <p>TestTalents Team <br> Thanks</p>
            </td>
        </tr>
    </table>
</body>

</html>
