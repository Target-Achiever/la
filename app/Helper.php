<?php
function displayAlert()
{

      if (Session::has('success'))
      {
         list($type, $message) = explode('|', Session::get('success'));
         return view('layouts.alert',compact('type','message'));
         // return sprintf('<div class="alert alert-%s">%s</div>',$type,$message);
      }
      return '';
}
function conversion_to_pound($value)
{
	$value = (float)$value / 100;

	return \Config::get('constants.currency').number_format($value,2);
}
function conversion_pound_without_currency($value)
{
   $value = (float)$value / 100;

   return number_format($value,2);
}
function conversion_pound_without_format($value)
{
   $value = (float)$value / 100;

   return $value;
}
function conversion_to_cent($value)
{
	$value = (float)$value * 100;

	return $value;
}
?>
