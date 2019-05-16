@extends('layouts.email')

@section('content')


          <table cellspacing="0" cellpadding="0" class="force-full-width" style="border:1px solid #ddd;">

			<tr style="background-color: #fff;padding-bottom: 250px;">

				<td><img src="{{URL::asset('images/email/approved.png')}}" style="

    padding-top: 50px;

" width="30%"></td>

			</tr>

            <tr>

              <td style="background-color: #fff;padding-top: 15px;">

              <center>     

                <table style="margin: 0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">

                  <tr>

                    <td style="text-align: center;">                    

                      <h4>Hi <span style="color:#00d4ff;">{{ ucfirst($userinfo->name)}}</span>,<br><br></h4>

                      <!-- <span style="background-color: #f1eff2;padding: 7px 20px;text-align: center;border-radius: 3px;"> Info@linkaesthetics.com </span>  -->

                      <p style="line-height: 1.5;font-size:15px;">Thank you for registering an account with Linkaesthetics. We are excited to have you on board. Please click the link below to verify your email.</p>

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

                          <a href="{{url('user-activation').'/'.$token}}"

                        style="background-color: #00d4ff;color:#ffffff;display:inline-block;font-family:'Source Sans Pro', Helvetica, Arial, sans-serif;font-size: 14px;font-weight:400;line-height: 35px;text-align:center;text-decoration:none;width: 125px;-webkit-text-size-adjust:none;border-radius: 50px;text-transform: capitalize;">Confirm me</a>

                          <!--[if mso]>

                        </center>

                      </v:rect>

                    <![endif]--></div>

                    <br>

                  </td>

                </tr>

              </table>

          @endsection
