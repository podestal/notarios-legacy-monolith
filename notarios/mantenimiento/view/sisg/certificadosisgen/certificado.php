<?php
include('../conexion.php');
 /*
if (getenv('HTTPS')=='on'){ 
   $cert=$_SERVER['SSL_CLIENT_CERT']; 
 }else{ 
   	$fname = "09533461.p12";
 	$f = fopen($fname, "r"); 
   
 $cert = fread($f, filesize($fname)); 
 fclose($f); 

 } 

 $datos = array();
 $pass = "1111";

 openssl_pkcs12_read($cert, $datos, $pass);
 $datos = openssl_x509_parse($datos['cert'],0);
 
 print_r($datos);*/
 /*


if (!$almacén_cert = file_get_contents("09533461.p12")) {
    echo "Error: No se puede leer el fichero del certificado\n";
    exit;
}

if (openssl_pkcs12_read($almacén_cert, $info_cert, "1111")) {
    echo "Información del certificado\n";
	
	
    print_r($info_cert);
	
	$grabardatatemp="INSERT INTO certificadosisgen(valor) VALUES ('$info_cert')";
	mysql_query($grabardatatemp,$conn) or die(mysql_error());
	
} else {
    echo "Error: No se puede leer el almacén de certificados.\n";
    exit;
}

    */
	
	
	
	
	
	
			
		$p12cert = array();		
		$file = '09533461.p12';		
		$pass = "1111";
		$fd = fopen($file, 'r');
		$p12buf = fread($fd, filesize($file));
		
		$xml = '../text.xml';		
		$xml2 = fopen($xml, 'r');
		$xml3 = fread($xml2, filesize($xml));
		
		fclose($fd);
		echo "<h1>INFORMACION DEL CERTIFICADO</h1>";
		if ( openssl_pkcs12_read($p12buf, $p12cert, $pass) )
		{
		   echo "Funciona";
		}
		else
		{
			echo "No funciona";
		}
		$privatekey = $p12cert["pkey"];
		$res=openssl_pkey_new();
		openssl_pkey_export($res, $p12cert["pkey"]);
		$publickey=openssl_pkey_get_details($res);
		$publickey2=$publickey["key"];

		echo "<h2>Private Key:</h2>$privatekey<br><h2>Public Key:</h2>$publickey2<BR>";

		$cleartext = htmlentities($xml3);

		echo "<h2>Original:</h2>$cleartext<BR><BR>";

		openssl_public_encrypt($cleartext, $crypttext, $publickey2);

		echo "<h2>Encriptada:</h2>$crypttext<BR><BR>";

		$PK2=openssl_get_privatekey($p12cert["pkey"]);

		$Crypted=openssl_private_decrypt($crypttext,$Decrypted,$PK2);
		if (!$Crypted) {
		   $MSG.="<p class='error'>Imposible desencriptar ($CCID).</p>";
		}else{
		   echo "<h2>Desencriptada:</h2>" . $Decrypted;
		}
		
		$grabardatatemp="INSERT INTO certificadosisgen(key1, key2) VALUES ('$privatekey','$publickey2')";
		mysql_query($grabardatatemp,$conn) or die(mysql_error());

	
?>