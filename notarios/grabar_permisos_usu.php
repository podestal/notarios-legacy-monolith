<style type="text/css">
.textito {
	text-align: center;
	font-family:Verdana, Geneva, sans-serif;
	font-size:16px;
	color:#036;
}
</style>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="textito">Permisos Grabados Correctamente..!</td>
  </tr>
</table>

<?php
include("conexion.php");
$idusuario=$_POST['iduser'];


if($_POST['1']==true){
	$kardex="1";
	}else{
	$kardex="0";	
		}

if($_POST['2']==true){
	$newkar="1";
	}else{
	$newkar="0";	
		}

if($_POST['3']==true){
	$editkar="1";
	}else{
	$editkar="0";	
		}

if($_POST['4']==true){
	$protesto="1";
	}else{
	$protesto="0";	
		}
		
if($_POST['5']==true){
	$newprot="1";
	}else{
	$newprot="0";	
		}
		
if($_POST['6']==true){
	$editprot="1";
	}else{
	$editprot="0";	
		}

if($_POST['7']==true){
	$pviaje="1";
	}else{
	$pviaje="0";	
		}

if($_POST['8']==true){
	$newvia="1";
	}else{
	$newvia="0";	
		}

if($_POST['9']==true){
	$editvia="1";
	}else{
	$editvia="0";	
		}

if($_POST['10']==true){
	$poder="1";
	}else{
	$poder="0";	
		}
		
if($_POST['11']==true){
	$newpod="1";
	}else{
	$newpod="0";	
		}
		
if($_POST['12']==true){
	$editpod="1";
	}else{
	$editpod="0";	
		}
		
if($_POST['13']==true){
	$cartas="1";
	}else{
	$cartas="0";	
		}

if($_POST['14']==true){
	$newcar="1";
	}else{
	$newcar="0";	
		}

if($_POST['15']==true){
	$editcar="1";
	}else{
	$editcar="0";	
		}

if($_POST['16']==true){
	$libros="1";
	}else{
	$libros="0";	
		}
		
if($_POST['17']==true){
	$newlib="1";
	}else{
	$newlib="0";	
		}
		
if($_POST['18']==true){
	$editlib="1";
	}else{
	$editlib="0";	
		}
		
if($_POST['19']==true){
	$capaz="1";
	}else{
	$capaz="0";	
		}

if($_POST['20']==true){
	$newcap="1";
	}else{
	$newcap="0";	
		}

if($_POST['21']==true){
	$editcap="1";
	}else{
	$editcap="0";	
		}

if($_POST['22']==true){
	$incapaz="1";
	}else{
	$incapaz="0";	
		}
		
if($_POST['23']==true){
	$newinca="1";
	}else{
	$newinca="0";	
		}
		
if($_POST['24']==true){
	$editinca="1";
	}else{
	$editinca="0";	
		}
		
if($_POST['25']==true){
	$domiciliario="1";
	}else{
	$domiciliario="0";	
		}

if($_POST['26']==true){
	$newdom="1";
	}else{
	$newdom="0";	
		}

if($_POST['27']==true){
	$editdom="1";
	}else{
	$editdom="0";	
		}

if($_POST['28']==true){
	$caracteristicas="1";
	}else{
	$caracteristicas="0";	
		}
		
if($_POST['29']==true){
	$newcarac="1";
	}else{
	$newcarac="0";	
		}
		
if($_POST['30']==true){
	$editcarac="1";
	}else{
	$editcarac="0";	
		}
		
if($_POST['31']==true){
	$indicronoep="1";
	}else{
	$indicronoep="0";	
		}

if($_POST['32']==true){
	$indicronono="1";
	}else{
	$indicronono="0";	
		}

if($_POST['33']==true){
	$indicronotv="1";
	}else{
	$indicronotv="0";	
		}

if($_POST['34']==true){
	$indicronogm="1";
	}else{
	$indicronogm="0";	
		}
		
if($_POST['35']==true){
	$indicronotest="1";
	}else{
	$indicronotest="0";	
		}
		
if($_POST['39']==true){
	$indicronoprot="1";
	}else{
	$indicronoprot="0";	
		}
		
if($_POST['40']==true){
	$infocamacome="1";
	}else{
	$infocamacome="0";	
		}

if($_POST['41']==true){
	$indicronocar="1";
	}else{
	$indicronocar="0";	
		}

if($_POST['42']==true){
	$indicronolib="1";
	}else{
	$indicronolib="0";	
		}

if($_POST['43']==true){
	$indicronovia="1";
	}else{
	$indicronovia="0";	
		}
		
if($_POST['44']==true){
	$indicronopod="1";
	}else{
	$indicronopod="0";	
		}
		
if($_POST['45']==true){
	$indicronocapaz="1";
	}else{
	$indicronocapaz="0";	
		}
		
if($_POST['46']==true){
	$indicronoincapaz="1";
	}else{
	$indicronoincapaz="0";	
		}

if($_POST['47']==true){
	$alfaep="1";
	}else{
	$alfaep="0";	
		}

if($_POST['48']==true){
	$alfagm="1";
	}else{
	$alfagm="0";	
		}

if($_POST['49']==true){
	$alfanc="1";
	}else{
	$alfanc="0";	
		}
		
if($_POST['50']==true){
	$alfatv="1";
	}else{
	$alfatv="0";	
		}
		
if($_POST['51']==true){
	$alfatesta="1";
	}else{
	$alfatesta="0";	
		}
		
if($_POST['52']==true){
	$pdtep="1";
	}else{
	$pdtep="0";	
		}

if($_POST['53']==true){
	$pdtgm="1";
	}else{
	$pdtgm="0";	
		}

if($_POST['54']==true){
	$pdtveh="1";
	}else{
	$pdtveh="0";	
		}

if($_POST['55']==true){
	$pdtlib="1";
	}else{
	$pdtlib="0";	
		}
		
if($_POST['56']==true){
	$ro="1";
	}else{
	$ro="0";	
		}
		
if($_POST['57']==true){
	$reportuif="1";
	}else{
	$reportuif="0";	
		}
		
if($_POST['58']==true){
	$reportpendfirma="1";
	}else{
	$reportpendfirma="0";	
		}

if($_POST['59']==true){
	$emicompro="1";
	}else{
	$emicompro="0";	
		}

if($_POST['60']==true){
	$anucompro="1";
	}else{
	$anucompro="0";	
		}

if($_POST['61']==true){
	$cancelcompro="1";
	}else{
	$cancelcompro="0";	
		}
		
if($_POST['62']==true){
	$reportcomproemi="1";
	}else{
	$reportcomproemi="0";	
		}
		
if($_POST['63']==true){
	$pendpago="1";
	}else{
	$pendpago="0";	
		}
		
if($_POST['64']==true){
	$cancelados="1";
	}else{
	$cancelados="0";	
		}

if($_POST['65']==true){
	$manteusu="1";
	}else{
	$manteusu="0";	
		}

if($_POST['66']==true){
	$permiusu="1";
	}else{
	$permiusu="0";	
		}

if($_POST['67']==true){
	$tipoacto="1";
	}else{
	$tipoacto="0";	
		}
		
if($_POST['68']==true){
	$mantecondi="1";
	}else{
	$mantecondi="0";	
		}
		
if($_POST['69']==true){
	$manteclie="1";
	}else{
	$manteclie="0";	
		}
		
if($_POST['70']==true){
	$manteimpe="1";
	}else{
	$manteimpe="0";	
		}

if($_POST['71']==true){
	$sellocartas="1";
	}else{
	$sellocartas="0";	
		}

if($_POST['72']==true){
	$helpprot="1";
	}else{
	$helpprot="0";	
		}

if($_POST['73']==true){
	$contpod="1";
	}else{
	$contpod="0";	
		}
		
if($_POST['74']==true){
	$manteservi="1";
	}else{
	$manteservi="0";	
		}
		
if($_POST['75']==true){
	$asignaregis="1";
	}else{
	$asignaregis="0";	
		}

if($_POST['76']==true){
	$tipo_cambio="1";
	}else{
	$tipo_cambio="0";	
		}

if($_POST['77']==true){
	$seriescaja="1";
	}else{
	$seriescaja="0";	
		}

if($_POST['78']==true){
	$datonot="1";
	}else{
	$datonot="0";	
		}

if($_POST['79']==true){
	$editdatonot="1";
	}else{
	$editdatonot="0";	
		}
		
if($_POST['80']==true){
	$regserver="1";
	}else{
	$regserver="0";	
		}
		
if($_POST['89']==true){
	$sisgen="1";
	}else{
	$sisgen="0";	
		}
		
if($_POST['81']==true){
	$editserver="1";
	}else{
	$editserver="0";	
		}
		if($_POST['99']==true){
	$editabogado="1";
	}else{
	$editabogado="0";	
		}
		
$consulta2 = mysql_query("SELECT * FROM permisos_usuarios where idusuario=$idusuario", $conn) or die(mysql_error());
$rowuser2 = mysql_fetch_array($consulta2);

if($rowuser2['idusuario']!=""){
	mysql_query("update permisos_usuarios  set kardex='$kardex', newkar='$newkar', editkar='$editkar', protesto='$protesto', newprot='$newprot', editprot='$editprot', pviaje='$pviaje', newvia='$newvia', editvia='$editvia', poder='$poder', newpod='$newpod', editpod='$editpod', cartas='$cartas', newcar='$newcar', editcar='$editcar', libros='$libros', newlib='$newlib', editlib='$editlib', capaz='$capaz', newcap='$newcap', editcap='$editcap', incapaz='$incapaz', newinca='$newinca', editinca='$editinca', domiciliario='$domiciliario', newdom='$newdom', editdom='$editdom', caracteristicas='$caracteristicas', newcarac='$newcarac', editcarac='$editcarac', indicronoep='$indicronoep', indicrononc='$indicronono', indicronotv='$indicronotv', indicronogm='$indicronogm', indicronotest='$indicronotest', indicronoprot='$indicronoprot', infocamacome='$infocamacome', indicronocar='$indicronocar', indicronolib='$indicronolib', indicronovia='$indicronovia', indicronopod='$indicronopod', indicronocapaz='$indicronocapaz', indicronoincapaz='$indicronoincapaz', alfaep='$alfaep', alfagm='$alfagm', alfanc='$alfanc', alfatv='$alfatv', alfatesta='$alfatesta', pdtep='$pdtep', pdtgm='$pdtgm', pdtveh='$pdtveh', pdtlib='$pdtlib', ro='$ro', reportuif='$reportuif', reportpendfirma='$reportpendfirma', emicompro='$emicompro', anucompro='$anucompro', cancelcompro='$cancelcompro', reportcomproemi='$reportcomproemi', pendpago='$pendpago', cancelados='$cancelados', manteusu='$manteusu', permiusu='$permiusu', tipoacto='$tipoacto', mantecondi='$mantecondi', manteclie='$manteclie', manteimpe='$manteimpe', sellocartas='$sellocartas', helpprot='$helpprot', contpod='$contpod', manteservi='$manteservi', asignaregis='$asignaregis', tipo_cambio='$tipo_cambio', seriescaja='$seriescaja', datonot='$datonot', editdatonot='$editdatonot', regserver='$regserver', editserver='$editserver' , mant_abogado='$editabogado', sisgen='$sisgen'  where idusuario='$idusuario'", $conn) or die(mysql_error());
	
	}else{
		
	mysql_query("INSERT INTO permisos_usuarios (idusuario, kardex, newkar, editkar, protesto, newprot, editprot, pviaje, newvia, editvia, poder, newpod, editpod, cartas, newcar, editcar, libros, newlib, editlib, capaz, newcap, editcap, incapaz, newinca, editinca, domiciliario, newdom, editdom, caracteristicas, newcarac, editcarac, indicronoep, indicrononc, indicronotv, indicronogm, indicronotest, indicronoprot, infocamacome, indicronocar, indicronolib, indicronovia, indicronopod, indicronocapaz, indicronoincapaz, alfaep, alfagm, alfanc, alfatv, alfatesta, pdtep, pdtgm, pdtveh, pdtlib, ro, reportuif, reportpendfirma, emicompro, anucompro, cancelcompro, reportcomproemi, pendpago, cancelados, manteusu, permiusu, tipoacto, mantecondi, manteclie, manteimpe, sellocartas, helpprot, contpod, manteservi, asignaregis, tipo_cambio, seriescaja, datonot, editdatonot, regserver, editserver,mant_abogado,sisgen) VALUES ('$idusuario', '$kardex', '$newkar', '$editkar', '$protesto', '$newprot', '$editprot', '$pviaje', '$newvia', '$editvia', '$poder', '$newpod', '$editpod', '$cartas', '$newcar', '$editcar', '$libros', '$newlib', '$editlib', '$capaz', '$newcap', '$editcap', '$incapaz', '$newinca', '$editinca', '$domiciliario', '$newdom', '$editdom', '$caracteristicas', '$newcarac', '$editcarac', '$indicronoep', '$indicronono', '$indicronotv', '$indicronogm', '$indicronotest', '$indicronoprot', '$infocamacome', '$indicronocar', '$indicronolib', '$indicronovia', '$indicronopod', '$indicronocapaz', '$indicronoincapaz', '$alfaep', '$alfagm', '$alfanc', '$alfatv', '$alfatesta', '$pdtep', '$pdtgm', '$pdtveh', '$pdtlib', '$ro', '$reportuif', '$reportpendfirma', '$emicompro', '$anucompro', '$cancelcompro', '$reportcomproemi', '$pendpago', '$cancelados', '$manteusu', '$permiusu', '$tipoacto', '$mantecondi', '$manteclie', '$manteimpe', '$sellocartas', '$helpprot', '$contpod', '$manteservi', '$asignaregis', '$tipo_cambio', '$seriescaja', '$datonot', '$editdatonot', '$regserver', '$editserver','$editabogado','$sisgen')", $conn) or die(mysql_error());
		
		}

?>