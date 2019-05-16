@extends('layouts.email')
@section('content')
        <table cellspacing="0 " cellpadding="0 " class="force-full-width " style="border:1px solid #ddd; ">
            <tr style="background-color: #fff;padding-bottom: 250px; ">
                <td>
                    <img src="{{ URL::asset( '/images/Admin_Active.png') }} " style="padding-top: 50px; " width="50%">
                </td>
            </tr>
            <tr>
                <td style="background-color: #fff;padding-top: 15px; ">
                    <center>
                        <table style="margin: 0 auto; " cellspacing="0 " cellpadding="0 " class="force-width-80 ">
                            <tr>
                                <td style="text-align: center;"><h4>Hi <span style="color:#00d4ff;">{{ ucfirst($user['name']) }}</span>,
                                        <br><br></h4>
                                    <p>Please confirm your email and unlock opportunities.</p>
                                    <p>Thank you for registering an account with LinkAesthetics. First things first, we need to verify your email and get your consent!</p>
                                    <p>LinkAesthetics is strongly committed to protecting the privacy of personal data that we maintain about clients, providers and other individuals.</p>
                                    <p> By giving your consent, we will send you relevant marketing information on great deals and offers, discounts and news on exciting aesthetics products.</p>
                                    <p> You will have the opportunity to opt out of receiving communication from us every time we contact you. You may also wish to read our privacy statement[please link our privacy statement here] for more information on how we use your personal data.</p>
                                    <p> If you decide that you don’t want to receive marketing content from LinkAesthetics, please note that we may still be required to send you emails regarding factual, transactional and/or servicing information in connection with products and services that we provide you.                                </p>
                                    <p>Would you like to receive our promotion emails? </p>
                                    <p>You have the right to withdraw your consent at any time.</p>
                                </td>
                            </tr>
                        </table>
                    </center>
                    <table style="margin:0 auto;border-bottom:1px solid #ddd; " cellspacing="0 " cellpadding="10 " width="100% ">
                        <tr>
                            <td style="text-align:center; margin:0 auto; ">
                                <div>
                                    <!--[if mso]>
                                    <v:rect
                                            xmlns:v="urn:schemas-microsoft-com:vml "
                                            xmlns:w="urn:schemas-microsoft-com:office:word " href="# " style="height:45px;v-text-anchor:middle;width:180px; " stroke="f " fillcolor="#fe9829 ">
                                        <w:anchorlock/>
                                        <center>
                                    <![endif]-->
                                    <a href="{{url( 'user_buss_status/'.$user[ 'id'])}} "                                       style="background-color: #00d4ff;color:#ffffff;display:inline-block;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;font-size: 14px;font-weight:400;line-height: 35px;text-align:center;text-decoration:none;width: 125px;-webkit-text-size-adjust:none;border-radius: 50px;text-transform: capitalize; "> Confirm </a>
                                    <!--[if mso]>
                                    </center>
                                    </v:rect>
                                    <![endif]-->
                                </div>
                                <br>
                            </td>
                        </tr>
                    </table>
                   @endsection