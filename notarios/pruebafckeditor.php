<?php 
include("fckeditor/fckeditor.php") ; 
include('conexion.php');
//$sql2 = "SELECT * FROM paginas WHERE idpagina='13'";
//$result2 = mysql_query($sql2,$conn) or die(mysql_error());
//$rowcont = mysql_fetch_array($result2);

;
?> 
<html> 
<head> 
<title>FCKeditor - Sample</title> 
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
<strong class="DSA"><span class="s"> Modificar Nosotros  <br>
<br>
</span> </strong>
<form action="grabarnosotros.php" method="post"> 
  <?php 
    $oFCKeditor = new FCKeditor('pagmisi') ;
    $oFCKeditor->BasePath = 'fckeditor/';
    $oFCKeditor->Width  = '940' ;
    $oFCKeditor->Height = '500' ;
	$oFCKeditor->Value = '';
    $oFCKeditor->Create() ;
?> 
  <br /> 
<input type="submit" value="Submit"> 
</form> 
</body> 
</html>