<?php

include("conexion.php");
include("fckeditor/fckeditor.php") ; 

$numkar = $_REQUEST["numkar"];
?>
<html> 
<head> 
<title>Ingreso de la Minuta</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<style type="text/css">
.s {
	font-family: Verdana, Geneva, sans-serif;
	
}
strong {
	font-size: 16px;
}
.DSA {
	font-size: 18px;
}
.SS {
	font-size: 18px;
}
</style>
</head> 
<body>
<form action="Update_kardexMinuta.php" method="post"> 
<?php 
    $oFCKeditor = new FCKeditor('pagmisi') ;
    $oFCKeditor->BasePath = 'fckeditor/';
    $oFCKeditor->Width  = '741' ;
    $oFCKeditor->Height = '570' ;
	$oFCKeditor->Value = '';
    $oFCKeditor->Create() ;
?> 
  <br /> 
<input type="text" id="num_kardex" name="num_kardex" value="<?php echo $numkar; ?>" />  
<input type="submit" value="Grabar Minuta"> 
</form> 
</body> 
</html>
