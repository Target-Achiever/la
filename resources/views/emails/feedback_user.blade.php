@extends('layouts.email')

@section('content')
          <table cellspacing="0" cellpadding="0" class="force-full-width" style="border:1px solid #ddd;">
			<tr style="background-color: #fff;padding-bottom: 250px;">
				<td><img src="{{url('images').'/email/appointment.png'}}" style="
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
                      <p> You have successfully sent the below feedback.</p>
                      <p>{{ $content->feedback }}</p>
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
             @endsection