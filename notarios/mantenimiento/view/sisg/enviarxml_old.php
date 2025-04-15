<?php

//header('Content-Type: application/xml; charset=utf-8');

/*$soap_request .= "<?xml version='1.0'?>\r\n";*/
$soap_request .= "<SOAP-ENV:Envelope xmlns:SOAP-ENV='http://schemas.xmlsoap.org/soap/envelope/'>\n";
$soap_request .= "\t<SOAP-ENV:Body>\n";
$soap_request .= "\t\t<setDocumentosNotariales xmlns='http://ws.sisgen.ancert.notariado.org/'>\n";
$soap_request .= "\t\t\t<arg0 xmlns=''><![CDATA[";


$file = fopen("text.xml", "r") or exit("Unable to open file!");
//Output a line of the file until the end is reached
while(!feof($file))
{
$soap_request .=fgets($file);
}
fclose($file);




$soap_request .= "\t\t\t]]></arg0>";
$soap_request .= "\t\t</setDocumentosNotariales>\n";
$soap_request .= "\t</SOAP-ENV:Body>\n";
$soap_request .= "</SOAP-ENV:Envelope>\n";


  $header = array(
    "Content-type: text/xml;charset=\"utf-8\"",
    "Accept: text/xml",
    "Cache-Control: no-cache",
    "Pragma: no-cache",
    "SOAPAction: \"http://ws.sisgen.ancert.notariado.org/DocumentosNotarialesSOAPService/setDocumentosNotariales\"",
    "Content-length: ".strlen($soap_request),
  );

  $soap_do = curl_init();
  curl_setopt($soap_do, CURLOPT_URL, "https://test.www.notariado.org/sisgen-web/DocumentosNotarialesService" );
  curl_setopt($soap_do, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
  curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($soap_do, CURLOPT_TIMEOUT,        500);
  curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, true); 
  curl_setopt($soap_do, CURLOPT_CAINFO, "ancert.cer");
  curl_setopt($soap_do, CURLOPT_POST,           1 );
  curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $soap_request);
  curl_setopt($soap_do, CURLOPT_HTTPHEADER,     $header);
/*
  if(curl_exec($soap_do) === false) {
    $err = 'Curl error: ' . curl_error($soap_do);
    curl_close($soap_do);
    print $err;
  } else {
    curl_close($soap_do);
    print 'Operation completed without any errors';
  }
  */
 // echo $soap_request;

 	$response = curl_exec($soap_do);
 
	if(curl_exec($soap_do) === false)
	{
		echo 'Curl error: ' . curl_error($soap_do);
	}
	else
	{
		$tokens = explode("\n", trim($response));
 
		print_r($tokens);
 
	}
 
	// close cURL resource, and free up system resources
	curl_close($soap_do);;
?>
