<?php 
date_default_timezone_set("America/Lima");

include_once("../extraprotocolares/view/funciones.php");
$conexion = Conectar();

$sql="select * from servidor where idservidor='1'";
$rpta=mysql_query($sql,$conexion) or die(mysql_error());
$rowaa=mysql_fetch_array($rpta);
$serveraa = $rowaa['nombre'];

$sqlnaa="select * from confinotario where idnotar='1'";
$rptaaan=mysql_query($sqlnaa,$conexion) or die(mysql_error());
$rowaan=mysql_fetch_array($rptaaan);
$notarioname = $rowaan['nombre']." ".$rowaan['apellido'];

?>
<table width="500" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td height="32" colspan="4" align="center"><span style="font-family:Verdana, Geneva, sans-serif; font-size:18px; color:#036;">Sistema Integrado de Gestion Notarial</span></td>
  </tr>
  <tr>
    <td width="171" height="30" align="right"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036;">Notaria :</span></td>
    <td height="30" colspan="3"><span style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#333;"><?php echo $notarioname; ?></span></td>
  </tr>
  <tr>
    <td height="30" align="right"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036;">Host :</span></td>
    <td width="96" height="30"><span style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#333;"><?php echo $serveraa;?></span></td>
    <td height="30">&nbsp;</td>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" align="right"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036;">Tiempo de generación :</span></td>
    <td height="30"><span style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#333;"><?php echo date('M d, Y'); ?></span></td>
    <td height="30"><span style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#036;">a horas </span></td>
    <td height="30"><span style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#333;"><?php echo date('g:i - A'); ?></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="68">&nbsp;</td>
    <td width="152">&nbsp;</td>
  </tr>
</table>
<?php

include_once("mysql.class.inc");
include_once("config.php");
$recibe=$_POST['kardexxx'];

$backup	= new MyBackUp(); //creating an object of MyBackUp

//SERVER CONFIG
if(!empty($server['host']))
	$backup->server	= $server['host']; //Joining the configuration Server data to class Server variables.
if(!empty($server['port']))
	$backup->port	= $server['port'];
if(!empty($server['user']))
	$backup->usern	= $server['user'];

$backup->userp	= $server['pass'];
$backup->dbase	= $server['database'];

//Mail Config
if(!empty($mailer["FromMail"]))
	$backup->mailFrom = $mailer["FromMail"];
if(!empty($mailer["ToMail"]))
	$backup->mailTo = $mailer["ToMail"];

	$backup->body = $mailer["MailBody"];
	$backup->isDel= $mailer["DAS"];

//FILENAME GENERATION
//UNIQUE FILE NAME GENERATION TO SET ONE BACKUP A DAY. Change the date function to time if you need more than on file per day. 
	$backup->filename = $backUpFolder."/".$server['database']."_".date("Y_M_d")."_".date("g_i_A").".sql";

//Calling generator Function
if(!$backup->BackUp())
	echo $backup->error; //On error this function returns back. Error details will be in this variable.

//For more details Please visit: http://is.gd/5b3Xk

?>
