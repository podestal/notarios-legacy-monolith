<?php 
session_start();
include("conexion1.php");	
include("extraprotocolares/view/funciones.php");
$id	= $_REQUEST['id'];
$query="select kardex,observacion from documentogenerados where id='$id'";
$queryLast=mysqli_query($conn_i,$query);
$row=mysqli_fetch_assoc($queryLast);
?>

<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
    	<td align="justify">
        <span class="TITULO" style="margin-left:20px;color:#fff">
        OBSERVACION DEL KARDEX <?php echo $row["kardex"]?>
        </span>
        </td>
    	<td align="right">
        <a onClick="cerrarObsEscri()">
        <img src="iconos/cerrar.png">
        </a></td>
    </tr>
    <tr>
    	<td align="right">&nbsp;</td>
    </tr>

    <tr>
        <td align="center" width="15%" colspan="2">
        
        <textarea id="obs" name="obs" class="TITULO21" style="width:90%;height:130px;text-transform:uppercase;"><?php echo $row["observacion"]; ?></textarea>
        </td>                        
    </tr> 
</table>