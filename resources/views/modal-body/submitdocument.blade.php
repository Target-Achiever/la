<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Linkaesthetics</title>
    <style type="text/css">
        /* Take care of image borders and formatting */
        img {
            max-width: 600px;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
            margin: 0 auto;
            display: block;
        }
        a img { border: none; }
        table { border-collapse: collapse !important; }
        #outlook a { padding:0; }
        .ReadMsgBody { width: 100%; }
        .ExternalClass {width:100%;}
        .backgroundTable {margin:0 auto; padding:0; width:100%;}
        table td {border-collapse: collapse;}
        .ExternalClass * {line-height: 115%;}
        /* General styling */
        td {
            font-family: Arial, sans-serif;
            color: #6f6f6f;
        }
        h1 {
            margin: 10px 0;
        }
        a {
            color: #27aa90;
            text-decoration: none;
        }
        .force-full-width {
            width: 100% !important;
        }
        .force-width-80 {
            width: 80% !important;
        }
        .body-padding {
            padding: 0 75px;
        }
        .mobile-align {
            text-align: right;
        }

    </style>
</head>
<body  class="body" style="padding:0; margin:0; display:block;>
<table align="center" cellpadding="0" cellspacing="0" width="100%">
<tr>
    <td align="center" valign="top" style="width="100%">

    <center>
        <table cellspacing="0" cellpadding="0" width="450" style="margin:20px auto; class="w320">
<tr>
    <td align="center" valign="top">
        <table style="margin:0 auto;" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td style="background-color: transparent;">
                    <!-- <a href="#"><img class="w320" src="{{url('images').'/logo.png'}}" style="max-height:70px;" alt="logo" /></a> -->
                    <a href="#"><img class="w320" src="{{ URL::asset('/images/logo.png') }}" style="max-height:70px;padding-bottom: 10px;" alt="logo" /></a>
                </td>
            </tr>
        </table>

        <table cellspacing="0" cellpadding="0" class="force-full-width" style="border:1px solid #ddd;">
            <tr style="background-color: #fff;padding-bottom: 250px;">
                <td><img src="{{ URL::asset('/images/Admin_Active.png') }}" style="padding-top: 50px;"></td>
            </tr>
            <tr>
                <td style="background-color: #fff;padding-top: 15px;">
                    <center>
                        <table style="margin: 0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
                            <tr>
                                <td style="text-align: center;">
                                    <h4>Hey <span style="color:#00d4ff;">{{ $user[0]['name'] }}</span>,
                                        <br><br>  Thank you submitted. Your document as been waiting for admin approval.</h4>
                                    <span style="background-color: #f1eff2;padding: 7px 20px;text-align: center;border-radius: 3px;">   Info@linkaesthetics.com </span>

                                </td>
                            </tr>
                        </table>
                    </center>
                    <table style="margin:0 auto;border-bottom:1px solid #ddd;" cellspacing="0" cellpadding="10" width="100%">
                        <tr>
                            <td style="text-align:center; margin:0 auto;">
                                <div><!--[if mso]>
                                    <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:45px;v-text-anchor:middle;width:180px;" stroke="f" fillcolor="#fe9829">
                                        <w:anchorlock/>
                                        <center>
                                    <![endif]-->

                                    <!--[if mso]>
                                    </center>
                                    </v:rect>
                                    <![endif]--></div>
                                <br>
                            </td>
                        </tr>
                    </table>
                    <table cellspacing="0" cellpadding="0" bgcolor="#fff"  class="force-full-width">
                        <tr>
                            <td style="color:#333;font-size: 13px;text-align:center;padding: 10px 0 5px;">
                                © 2018 Linkaesthetics. All Rights Reserved
                            </td>
                        </tr>
                        <tr>
                            <td style="color:#333; font-size: 13px; text-align:center;">
                                <a href="#" style="color: #333;">Contact</a> | <a href="#" style="color: #333;">Terms</a> | <a href="#" style="color: #333;">Privacy</a>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px;">
                                &nbsp;
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
</table>
</center>
</td>
</tr>
</table>
</body>
</html>
