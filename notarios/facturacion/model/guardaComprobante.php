<?php
include('../../conexion.php');

$id_regventas   = $_POST["id_regventas"];   
$tipo_docu      = $_POST["tipo_docu"];   
$serie  	    = $_POST["serie"];   
$factura      	= $_POST["factura"];   
$fecha      	= $_POST["fecha"];  
$num_docu      	= $_POST["num_docu"];  
$kardex	      	= $_POST["kardex"];  
$codigo_cli    	= $_POST["codigo_cli"];   	
$concepto    	= $_POST["concepto"]; 
$estado         = "ACTIVO"; 	
$imp_total   	= $_POST["imp_total"];  
$subtotal   	= $_POST["subtotal"];   
$impuesto   	= $_POST["impuesto"];   
$tipo_sunat		= "" ;
$detalle    	= "" ;
$condicion  	= "" ;
$empleado   	= $_POST["empleado"];   	
$tipopago   	= $_POST["tipopago"];   
$pagoacta   	= 0.00 ;
$tip_ncre   	= "" ;
$ser_ncre   	= "" ;
$doc_ncre   	= "" ;
$banco      	= "" ;
$monedatipo	 	= $_POST["monedatipo"];   
$monto_igv	 	= $_POST["monto_igv"];

$swt_det	 	= $_POST["swt_det"];
$detraccion	 	= $_POST["detraccion"];

$swt_anul       = ""  ;
$tipo_cambi		= 0.00;
$fecha_ven		= ""  ;
$observacion	= ""  ;
$monedatipo		= "01";
$banco			= ""  ;
$cheque			= ""  ;

$num_desde	 	= $_POST["num_desde"];
$num_hasta	 	= $_POST["num_hasta"];

$id_numbouc     = $_POST["id_numbouc"];

#################################
### Operaciones antes de Guardar:

# tipo_movi
if($tipopago=="2")
	{
		$tipo_movi = "C"; 		  // CREDITO
		$saldo     = $imp_total;  // SALDO A COBRAR
		$swt_est   = "";		  // DOCUMENTO NO TERMINADO( NO CANCELADO)
	}
else{
		$tipo_movi = "A"; 	      // AL CONTADO
		$saldo     = 0.00;        // NO EXISTE SALDO
		$swt_est   = "T";		  // DOCUMENTO TERMINADO(CANCELADO)
	}	 

# Nuevo num. documento

$factura;
$new_factura = intval($factura) + 1;
$length = strlen((string) $new_factura);
# length del campo: 5
$new_numdocu = str_repeat('0', intval($length)).(string) $new_factura;
#################################
#################################

// VERIFICA LA EXISTENCIA DEL ID_VENTAS , SI EXISTE EDITA.

if($id_regventas =='')
{
// se arma el numero   formato:  'año + 000001';

$busidregventas = "SELECT CONCAT(YEAR(NOW()),REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(m_regventas.id_regventas,6) AS DECIMAL))+1))),
(MAX(CAST(RIGHT(m_regventas.id_regventas,6) AS DECIMAL))+1)) AS idregventas FROM m_regventas";

$numregventabus = mysql_query($busidregventas,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numregventabus);
$newidregventas  = $rownum[0];
if($newidregventas == '')
{
	$new_id_regventas = '2013000001';
}
else if($newidregventas != '')
{
	$new_id_regventas = $newidregventas;
}

// numero conrrelativo para la cuenta corriente:
$busidctacte = "SELECT CONCAT(YEAR(NOW()),REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(m_cteventas.id_ctaventas,6) AS DECIMAL))+1))),
(MAX(CAST(RIGHT(m_cteventas.id_ctaventas,6) AS DECIMAL))+1)) AS idctaventas FROM m_cteventas";

$numregctacte = mysql_query($busidctacte,$conn) or die(mysql_error());
$rowctacte = mysql_fetch_array($numregctacte);
$newidctacte  = $rowctacte[0];

if($newidctacte == '')
{
	$new_id_ctacte = '2013000001';
}
else if($newidctacte != '')
{
	$new_id_ctacte = $newidctacte;
}


########
echo "<input name='id_regventas' id='id_regventas' readonly='readonly' type='hidden' value='".$new_id_regventas."' style='font-family:Calibri; font-size:14px; color:#003366; border:none;' size='8'>";

########


$grabacomprobantes = "INSERT INTO m_regventas(id_regventas, tipo_docu, serie, factura, fecha, num_docu, kardex, codigo_cli, concepto, estado, imp_total, subtotal, impuesto, tipo_sunat, detalle, condicion, empleado, tipopago, pagoacta, tip_ncre, ser_ncre, doc_ncre, banco, monedatipo, monto_igv, swt_det, detraccion, num_desde, num_hasta) VALUES ('$new_id_regventas', '$tipo_docu', '$serie', '$factura', STR_TO_DATE('$fecha','%d/%m/%Y'), '$num_docu', '$kardex', '$codigo_cli', '$concepto', '$estado', '$imp_total', '$subtotal', '$impuesto', '$tipo_sunat', '$detalle', '$condicion', '$empleado', '$tipopago', '$pagoacta', '$tip_ncre', '$ser_ncre', '$doc_ncre', '$banco', '$monedatipo', '$monto_igv', '$swt_det', '$detraccion', '$num_desde', '$num_hasta')";
mysql_query($grabacomprobantes,$conn) or die(mysql_error());

## Crea Cuenta corriente:

$grabaCtaCte = "INSERT INTO m_cteventas(id_ctaventas, num_docu_cli, codigo_cli, tipo_movi, fecha, tipo_docu, serie, documento, kardex, concepto, importe, fecha_ven, saldo, swt_est, swt_anul, tipo_cambi, observacion, monedatipo, tipopago, banco, cheque, monto_igv, codiempl) VALUES ('$new_id_regventas', '$num_docu', '$codigo_cli', '$tipo_movi', STR_TO_DATE('$fecha','%d/%m/%Y'), '$tipo_docu', '$serie', '$factura', '$kardex', '$concepto', '$imp_total', STR_TO_DATE('$fecha_ven','%d/%m/%Y'), '$saldo', '$swt_est', '$swt_anul', '$tipo_cambi', '$observacion', '$monedatipo', '$tipopago', '$banco', '$cheque', '$monto_igv', '$empleado')";
mysql_query($grabaCtaCte,$conn) or die(mysql_error());

## Busca el ultimo documento por tipo
$busnumdocumen = "SELECT CONCAT(REPEAT('0',6-LENGTH((MAX(CAST(t_params.grp_item AS DECIMAL))+1))),
(MAX(CAST(t_params.grp_item AS DECIMAL))+1)) AS grpitem FROM t_params WHERE t_params.num_item = '$tipo_docu' ";
$consulnumdocu = mysql_query($busnumdocumen,$conn) or die(mysql_error());
$rownumdoc = mysql_fetch_array($consulnumdocu);
$new_num_doc = $rownumdoc["grpitem"];

## Actualiza numero de documentos.
$updateNumDocu = "UPDATE t_params SET t_params.grp_item = '$new_num_doc' WHERE t_params.num_item = '$tipo_docu'";
mysql_query($updateNumDocu,$conn) or die(mysql_error());

## Creando el numero de boucher
#####################
## Numero boucher ###
		if($tipopago != "2")
	    {
		$busnumboucIni = "SELECT CONCAT(REPEAT('0',10-LENGTH((MAX(CAST(m_regpagos.num_vouc AS DECIMAL))+1))),
		(MAX(CAST(m_regpagos.num_vouc AS DECIMAL))+1)) AS numvouc FROM m_regpagos";
			
		$numboucbusIni     = mysql_query($busnumboucIni,$conn) or die(mysql_error()); 
		$rownumIni         = mysql_fetch_array($numboucbusIni);
		$new_num_vouc_ini  = $rownumIni[0];
		
	    $grabaRegPagosIni = "INSERT INTO m_regpagos(id_regpagos, num_vouc, num_doc_cli, fec_pago, tipo_docu, serie, numero, imp_pago, id_mon, swt_est, usu_pago)
		VALUES (NULL, '$new_num_vouc_ini', '$num_docu', STR_TO_DATE('$fecha','%d/%m/%Y'), '$tipo_docu', '$serie', '$factura', '$imp_total', '$monedatipo', '', '$empleado')";
		mysql_query($grabaRegPagosIni,$conn) or die(mysql_error());

	echo "<input name='id_numbouc' id='id_numbouc' readonly='readonly' type='hidden' value='".$new_num_vouc_ini."' >";
	}
	else if ($tipopago == "2")
	{
		echo "<input name='id_numbouc' id='id_numbouc' readonly='readonly' type='hidden' value='' >";	
	}
#####################


// ############ GRABAR LOS DETALLES DEL DOCUMENTO CREADO ################### //

// ####  Guardar los datos de la tabla  ####

// PRUEBA CON VARIOS 11111
/*for($i=0;$i<=$_POST["txtNumRows"];$i++)
	{
		$data   = $_POST["datos".$i];
		$values = explode("|",$data);
		
		echo $values[0].'|'.$values[1].'|'.$values[2].'|'.$values[3].'|'.$values[4].'<br>' ;
		exit();

		
$savedetcomprobante = "INSERT INTO d_regventas(id_regventas, codigo, serie, documento, tipo_docu, kardex, detalle, precio, cantidad, grupo, monedatipo, monto_igv, grupempl, total, detalle_fac) VALUES('$id_regventas', '$values[0]', '$serie', '$documento', '$tipo_docu', '$kardex', '$values[1]', '$values[2]', '$values[3]', '$grupo', '$monedatipo', '$monto_igv', '$grupempl', '$values[4]', '$detalle_fac')";
mysql_query($savedetcomprobante, $conn) or die(mysql_error());			
	}
	
*/

	
/*	
$cdgprod      =   $values[0]; 
$descripcion  =   $values[1];  
$precio       =   $values[2];  
$cantidad     =   $values[3];  
$importe      =   $values[4]; 
*/

// PRUEBA CON VARIOS 22222
		
$param   = explode("┘",$_POST["txtTotServicios"]);
for($i=1;$i<=count($param)-1;$i++)
	{
 	 $xdatos = explode('|',$param[$i]);			
 	 //echo $xdatos[0].'|'.$xdatos[1].'|'.$xdatos[2].'|'.$xdatos[3].'|'.$xdatos[4].'<br/>';
 	 
	 
   $savedetcomprobante = "INSERT INTO d_regventas(id_regventas, codigo, serie, documento, tipo_docu, kardex, detalle, precio, cantidad, grupo, monedatipo, monto_igv, grupempl, total, detalle_fac) VALUES('$new_id_regventas', '$xdatos[0]', '$serie', '$num_docu', '$tipo_docu', '$kardex', '$xdatos[1]', '$xdatos[2]', '$xdatos[3]', '$grupo', '$monedatipo', '$monto_igv', '$grupempl', '$xdatos[4]', '$detalle_fac')";
mysql_query($savedetcomprobante, $conn) or die(mysql_error());			

	}
	//exit();
##############################################################################
##############################################################################

}

# PARA LA EDICIÓN 
if($id_regventas != '')
{

$updatecomprobantes = "UPDATE m_regventas SET m_regventas.tipo_docu='$tipo_docu', m_regventas.serie='$serie', m_regventas.factura='$factura', m_regventas.fecha=STR_TO_DATE('$fecha','%d/%m/%Y'), m_regventas.num_docu='$num_docu', m_regventas.kardex='$kardex', m_regventas.codigo_cli='$codigo_cli', m_regventas.concepto='$concepto', m_regventas.estado='$estado', m_regventas.imp_total='$imp_total', 
m_regventas.subtotal='$subtotal', m_regventas.impuesto='$impuesto', m_regventas.tipo_sunat='$tipo_sunat', m_regventas.detalle='$detalle', m_regventas.condicion='$condicion', 
m_regventas.empleado='$empleado', m_regventas.tipopago='$tipopago', m_regventas.pagoacta='$pagoacta', m_regventas.tip_ncre='$tip_ncre', m_regventas.ser_ncre='$ser_ncre', 
m_regventas.doc_ncre='$doc_ncre', m_regventas.banco='$banco', m_regventas.monedatipo='$monedatipo', m_regventas.monto_igv='$monto_igv', m_regventas.swt_det='$swt_det', m_regventas.detraccion='$detraccion',
m_regventas.num_desde='$num_desde', m_regventas.num_hasta='$num_hasta'
WHERE m_regventas.id_regventas = '$id_regventas'";
mysql_query($updatecomprobantes,$conn) or die(mysql_error());

$updateCtaCte = "UPDATE m_cteventas SET num_docu_cli = '$num_docu', codigo_cli = '$codigo_cli', tipo_movi = '$tipo_movi', fecha = STR_TO_DATE('$fecha','%d/%m/%Y'), 
tipo_docu = '$tipo_docu', serie = '$serie', documento = '$factura', kardex = '$kardex', concepto = '$concepto', 
importe = '$imp_total', fecha_ven = STR_TO_DATE('$fecha_ven','%d/%m/%Y'), saldo = '$saldo', swt_est = '$swt_est', swt_anul = '$swt_anul', tipo_cambi = '$tipo_cambi', 
observacion = '$observacion', monedatipo = '$monedatipo', tipopago = '$tipopago', banco = '$banco', cheque = '$cheque', monto_igv = '$monto_igv', codiempl = '$empleado'
WHERE id_ctaventas = '$id_regventas'";
mysql_query($updateCtaCte,$conn) or die(mysql_error());


## REGISTRA EL PAGO CON UN NUMERO DE BOUCHER :
	if($tipopago != "2")
	{
		#Para Edición:
	/*		

$numbouc_newbus  = "SELECT CONCAT(REPEAT('0',10-LENGTH((MAX(CAST(m_regpagos.num_vouc AS DECIMAL))))),(MAX(CAST(m_regpagos.num_vouc AS DECIMAL)))) AS numvouc FROM m_regpagos";
		$numboucbus2     = mysql_query($numbouc_newbus,$conn) or die(mysql_error()); 
		$rownumbouc      = mysql_fetch_array($numboucbus2);
		$numbouc_new     = $rownumbouc[0];
		
		if($numbouc_new=='')
		{
			## Numero boucher:
			$busnumbouc = "SELECT CONCAT(REPEAT('0',10-LENGTH((MAX(CAST(m_regpagos.num_vouc AS DECIMAL))+1))),
			(MAX(CAST(m_regpagos.num_vouc AS DECIMAL))+1)) AS numvouc FROM m_regpagos";
			
			$numboucbus    = mysql_query($busnumbouc,$conn) or die(mysql_error()); 
			$rownum        = mysql_fetch_array($numboucbus);
			$new_num_vouc  = $rownum[0];
			
	*/		
			##################
				
	/*		$grabaRegPagos = "INSERT INTO m_regpagos(id_regpagos, num_vouc, num_doc_cli, fec_pago, tipo_docu, serie, numero, imp_pago, id_mon, swt_est, usu_pago)
			VALUES (NULL, '$new_num_vouc', '$num_docu', STR_TO_DATE('$fecha','%d/%m/%Y'), '$tipo_docu', '$serie', '$factura', '$imp_total', '$monedatipo', '', '$empleado')";
			mysql_query($grabaRegPagos,$conn) or die(mysql_error());
			
	*/		
	/*	}
		else if($numbouc_new != '')
		{
	*/		
			$grabaRegPagos = "UPDATE m_regpagos SET imp_pago = '$imp_total',  usu_pago = '$empleado' WHERE m_regpagos.num_vouc = '$id_numbouc'";
			mysql_query($grabaRegPagos,$conn) or die(mysql_error());
			
			echo "<input name='id_numbouc' id='id_numbouc' readonly='readonly' type='hidden' value='".$id_numbouc."' >";	
	//	}
		
		
	}
	else if ($tipopago == "2")
	{
		echo "<input name='id_numbouc' id='id_numbouc' readonly='readonly' type='hidden' value='' >";	
	}
##############################################


################
echo "<input name='id_regventas' id='id_regventas' readonly='readonly' type='hidden' value='".$id_regventas."' style='font-family:Calibri; font-size:14px; color:#003366; border:none;' size='8'>";

################
	
}
mysql_close($conn);

?>


