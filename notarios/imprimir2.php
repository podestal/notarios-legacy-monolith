<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<?php 

$id=$_REQUEST['tip_comp'];

$sql=mysql_query("SELECT MAX(m_regventas.id_regventas) AS ultimo FROM m_regventas",$conn);
$res=mysql_fetch_assoc($sql);

?>

<script  type = "text/javascript" > 
function print ()  { 
    var iframe = document . getElementById ( 'textfile' ); 
    iframe . contentWindow . print (); 
} 
</script>

</head>

<body>

<?php
if($res['ultimo']==01){
	
	
}else if($res['ultimo']==02){
	
	echo '<iframe width="500" height="600" id = "textfile"  src = "../pdf/imprimir_texto.php?id_regventas='.$res[0].'" ></iframe> 
<button  onclick = " print () " > Print </button> ';


}else if($res['ultimo']==04){
	include("pdf_recibo.php");


}
 ?>



</body>
</html>