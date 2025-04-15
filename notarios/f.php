<?PHP 

$wsclient=new WSClient(array("wsdl"=>"http://www.notariadigital.org.pe:8080/sicnlws/obtenerImplicados.wsdl"));
$sproxy=$wsclient->getProxy();
$ret_val=$proxy->obtenerImplicados(array("CodNotaria"=>"12",
										"$fchInicio"=>"2015-08-01",
										"$fchFin"=>"2015-08-15",
										"$CodUsuario"=>"2"));
										
										echo $ret_val["result"]."\n";
										


?>