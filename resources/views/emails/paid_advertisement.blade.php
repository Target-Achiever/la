@extends('layouts.email')

@section('content')

          <table cellspacing="0" cellpadding="0" class="force-full-width" style="border:1px solid #ddd;">

			<tr style="background-color: #fff;padding-bottom: 250px;">

				<td><img src="{{ URL::asset('images/email/approved.png') }}" style="

    padding-top: 50px;

" width="30%"></td>

			</tr>

            <tr>

              <td style="background-color: #fff;padding-top: 15px;">

              <center>     

                <table style="margin: 0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">

                  <tr>

                      <td style="text-align: center;"><h4>Hi <span style="color:#00d4ff;">{{ ucfirst($adInfo->name) }}</span>,
                              <br><br></h4>

                      <p>'{{ ucfirst($adInfo->ad_header)}}' titled advertisement has been enrolled and is now live on our home page.</p>

                      <div style="background-color:#00d4ff;height: 1px;width:100px;margin:0 auto;"></div>

                        <center>

                          <table style="width: 100%;text-align: justify;margin-top: 30px;">

                              <tr>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">Advertisement details:</td>                                  

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;"></td>

                              </tr>

                              <tr>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">Advertiser</td>                                   

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">{{ ucfirst($adInfo->name) }}</td>

                              </tr>

                              <tr>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">Duration</td>                                  

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">{{$adInfo->time_slot != null ? $adInfo->time_slot : $adInfo->days_slots}}{{$adInfo->time_slot != null ? ' Week(s)' : ' Day(s)'}}</td>

                              </tr>

                              <tr>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">Period from</td>                                  

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">{{$adInfo->period_from}} To {{$adInfo->period_to}}</td>

                              </tr>

                              <tr>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">Amount paid</td>                                  

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">{{conversion_to_pound($adInfo->amount)}}</td>

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

                          <!--[if mso]>

                        </center>

                      </v:rect>

                    <![endif]--></div>

                    <br>

                  </td>

                </tr>

              </table>

          @endsection
