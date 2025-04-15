<?php session_start();
include("../../conexion.php");

$napepat=$_POST['napepat'];
$napemat=$_POST['napemat'];
$nprinom=$_POST['nprinom'];
$nsegnom=$_POST['nsegnom'];
$nombre=$_POST['napepat']." ".$_POST['napemat'].", ".$_POST['nprinom']." ".$_POST['nsegnom'];
$ndireccion=$_POST['ndireccion'];
$ubigensc=$_POST['ubigensc'];
$idestcivil=$_POST['idestcivil'];
$sexo=$_POST['sexo'];
$nacionalidad=$_POST['nacionalidad'];
$residente=$_POST['residente'];
$natper=$_POST['natper'];
$cumpclie=$_POST['cumpclie'];
$telcel=$_POST['telcel'];
$telofi=$_POST['telofi'];
$telfijo=$_POST['telfijo'];
$email=$_POST['email'];

$numdoc=$_POST['numdoc'];
$tipdoc=$_POST['tipdoc'];
$tipper=$_POST['tipper'];

$consulclien=mysql_query("Select * from cliente order by idcliente DESC LIMIT 1", $conn) or die(mysql_error());

$rowclin = mysql_fetch_array($consulclien);

$numeroc=$rowclin['idcliente'];
$sumac= intval($numeroc) + 1;
$cantidadc= strlen($sumac);


 switch ($cantidadc) {
	case "1":
	$ncliente="000000000".$sumac;
	break;
	case "2":
	$ncliente="00000000".$sumac;	
	break;
	case "3":
	$ncliente="0000000".$sumac;
	break;
	case "4":
	$ncliente="000000".$sumac;	
	break;
	case "5":
	$ncliente="00000".$sumac;
	break;
	case "6":
	$ncliente="0000".$sumac;	
	break;		
	case "7":
	$ncliente="000".$sumac;	
	break;	
	case "8":
	$ncliente="00".$sumac;	
	break;	
	case "9":
	$ncliente="0".$sumac;	
	break;
	case "10":
	$ncliente=$sumac;	
	break;			
}

$sql=mysql_query("insert into cliente (idcliente,tipper,apepat,apemat,prinom,segnom,nombre,direccion,idtipdoc,numdoc,email,telfijo,telcel,telofi,sexo,idestcivil,natper,nacionalidad,residente) 
values ('".$ncliente."',
		'".$tipper."',
		'".$napepat."',
		'".$napemat."',
		'".$nprinom."',
		'".$nsegnom."',
		'".$nombre."',
		'".$ndireccion."',
		".$tipdoc.",
		'".$numdoc."',
		'".$email."',
		'".$telfijo."',
		'".$telcel."',
		'".$telofi."',
		'".$sexo."',
		 ".$idestcivil.",
		'".$natper."',
		'".$nacionalidad."',
		'".$residente."')",$conn);
		
		if($sql){

			echo "<script>alert('El cliente ha sido registrado con exito');location.href ='IngCartasVie.php?val1=".$numdoc."&val2=".$tipdoc."&val3=".$nombre."&val4=".$telcel."&val5=".$ndireccion."&val6=".$tipper."';</script>";
		}else{
			echo "<script>alert('No se ha podido registrar al cliente');location.href ='javascript:history.back(1)';</script>";

		}
?>