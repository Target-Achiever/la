@php

$icon = array("success" => "check","danger" => "times","warning" => "exclamation-triangle","info" => "info-circle");

@endphp

<div class="alert alert-{{$type}} alert-white rounded notify"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> <div class="icon"> <i class="fa fa-{{$icon[$type]}}"></i> </div>{{$message}}</div>