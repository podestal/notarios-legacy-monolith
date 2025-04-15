<?php 
	
    include("../../extraprotocolares/view/funciones.php");
	
	$conexion = Conectar();
	
	$t_serv = $_REQUEST['id_servicio'];
	
	$sql_serv =    "SELECT
					servicios.id_servicio as id ,
					servicios.descrip as des,
					servicios.area1 as area 
					FROM
					servicios
					where servicios.id_servicio = $t_serv";
	
	$res_serv = mysql_query($sql_serv, $conexion);
	
	$serv = mysql_fetch_array($res_serv, MYSQL_ASSOC);
	
	//var_dump($serv);
	
	$id_area = $serv['area'];
	$id = $serv['id'];
	
	
/*
Numero
01 08 09 10 

Desde Hasta
03 05 07

Vacios
02 04  06 */

?>

<table width="261">

<?php 
if($id_area == '01' || $id_area == '08' || $id_area == '09' || $id_area == '10'){


	if($id==11 || $id==28){
		$valor="K";
	}else if($id==12 || $id==29){
		$valor="TV";
	}else if($id==13){
		$valor="KNC";
	}else if($id==55){
		$valor="GM";
	}else{
		$valor="";
	}

?>

	<tr>
    	<td><span class="camposss">Número:</span></td>
        <td><input id="num_kardex" name="num_kardex" class="camposss" style="width:50px" maxlength="9" value="<?php echo $valor;?>"/></td>
    </tr>
    
<?php 
}
	
if($id_area == '03' || $id_area == '05' || $id_area == '07'){
?>    
    <tr>
        <td><span class="camposss">Desde:</span></td>
        <td><input id="num_desde" name="num_desde" class="camposss" style="width:50px" maxlength="9" onKeyPress="return isNumberKey(event)"/></td>
        <td><span class="camposss">Hasta:</span></td>
        <td><input id="num_hasta" name="num_hasta" class="camposss" style="width:50px" maxlength="6" onKeyPress="return isNumberKey(event)"/></td>
    </tr>
    
<?php 
}
?>   
    
</table>