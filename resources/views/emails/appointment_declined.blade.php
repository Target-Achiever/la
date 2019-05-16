@extends('layouts.email')

@section('content')



          <table cellspacing="0" cellpadding="0" class="force-full-width" style="border:1px solid #ddd;">

      <tr style="background-color: #fff;padding-bottom: 250px;">

        <td><img src="{{url('images').'/email/rejected.png'}}" style="

    padding-top: 50px;

" width="30%"></td>

      </tr>

            <tr>

              <td style="background-color: #fff;padding-top: 15px;">

              <center>     

                <table style="margin: 0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">

                  <tr>

                      <td style="text-align: center;"><h4>Hi <span style="color:#00d4ff;"> {{ ucfirst($appInfo->requester_name) }} </span>,
                              <br><br></h4>

                          <p>Your appointment request for the {{$appInfo->service_type == '3' ? $appInfo->service_name : $appInfo->service}} has been declined.</p>

                      <div style="background-color:#00d4ff;height: 1px;width:100px;margin:0 auto;"></div>

                        <center>

                          <table style="width: 100%;text-align: justify;margin-top: 30px;">

                              <tr>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">Service</td>                                  

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">{{$appInfo->service_type == '3' ? $appInfo->service_name : $appInfo->service}}</td>

                              </tr>

                              @if($appInfo->service_type == '3')

                              <tr>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">Brand</td>                                  

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">{{$appInfo->service}}</td>

                              </tr>

                              @endif

                              <tr>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">Provider</td>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">{{ ucfirst($appInfo->provider_name)}}</td>

                              </tr>

                              <tr>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">Appointment date</td>                                   

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">{{$appInfo->preferred_date}}</td>

                              </tr>

                              <tr>

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">Appointment time</td>                                  

                                  <td style="border-bottom:1px solid #ddd;padding: 10px;border-collapse: collapse;line-height: 1.5;font-size: 13px;width:50%;">{{$appInfo->appointment_time_from}}</td>

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

