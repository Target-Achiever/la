@extends('layouts.email')

@section('content')


          <table cellspacing="0" cellpadding="0" class="force-full-width" style="border:1px solid #ddd;">

			<tr style="background-color: #fff;padding-bottom: 250px;">

				<td><img src="{{URL::asset('images/email/approved.png') }}" style="

    padding-top: 50px;

" width="30%"></td>

			</tr>

            <tr>

              <td style="background-color: #fff;padding-top: 15px;">

              <center>     

                <table style="margin: 0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">

                  <tr>

                      <td style="text-align: center;"><h4>Hi <span style="color:#00d4ff;">{{ ucfirst($name) }}</span>,
                              <br><br>  </h4>

                      <p>Payment has been successfully forwarded to the {{ ucfirst($name) }}'s stripe account. Please check payment details to ensure that they are correct.</p>

                      <div style="background-color:#00d4ff;height: 1px;width:100px;margin:0 auto;"></div>

                        <center>

                          <table style="width: 100%;text-align: justify;margin-top: 30px;">

                              <tr>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">Provider</td>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">{{ucfirst($name)}}</td>

                              </tr>

                              <tr>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">Transaction Id</td>                                   

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">{{$mailContent->id}}</td>

                              </tr>

                              <tr>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">Transferred Amount</td>                                  

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">{{conversion_to_pound($mailContent->amount)}}</td>

                              </tr>

                              <tr>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">Appointment cancelled</td>                                  

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">{{$cancelled}}</td>

                              </tr>

                              <tr>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">Amount taken for cancelled appointment(in percentage)</td>                                  

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">{{$fine}}</td>

                              </tr>

                              <tr>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">Date</td>                                  

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">{{\Carbon\Carbon::today()}}</td>

                              </tr>

                          </table>

                        </center>                     

                    </td>

                  </tr>

                </table>

              </center>

              <table style="margin:0 auto;border-bottom:1px solid #ddd;" cellspacing="0" cellpadding="10" width="100%">

                <tr>

                  <td style="text-align:center; margin:0 auto;">                 

                    <div style="margin-bottom: -15px;"><!--[if mso]>

                      <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:45px;v-text-anchor:middle;width:180px;" stroke="f" fillcolor="#fe9829">

                        <w:anchorlock/>

                        <center>

                      <![endif]-->

                          <a href=""

                        style="background-color: #00d4ff;color:#ffffff;display:inline-block;font-family:'Source Sans Pro', Helvetica, Arial, sans-serif;font-size: 14px;font-weight:400;line-height: 35px;text-align:center;text-decoration:none;width: 125px;-webkit-text-size-adjust:none;border-radius: 50px;"">My Account</a>

                          <!--[if mso]>

                        </center>

                      </v:rect>

                    <![endif]--></div>

                    <br>

                  </td>

                </tr>

              </table>

         @endsection

