<?php
include('conexion.php');
$tipdedoc=$_POST['tipodedocum'];
if($tipdedoc=="N"){
$sql=mysql_query("select * from tipodocumento where idtipdoc<>'8'",$conn) or die(mysql_error());
echo '<select name="selectdoc" id="selectdoc">';
while($rowi=mysql_fetch_array($sql)){
	
          echo '<option value="'.$rowi["idtipdoc"].'">'.$rowi["destipdoc"].'</option>';
	}
	echo'</select>';
}
if($tipdedoc=="J"){
$sql=mysql_query("SELECT * FROM tipodocumento WHERE idtipdoc<>'1' AND idtipdoc<>'2' AND idtipdoc<>'3' AND idtipdoc<>'4' AND idtipdoc<>'5' AND idtipdoc<>'6' AND idtipdoc<>'7' AND idtipdoc<>'9' AND idtipdoc<>'11'",$conn) or die(mysql_error());
echo '<select name="selectdoc" id="selectdoc">';
while($rowi=mysql_fetch_array($sql)){
	
          echo '<option value="'.$rowi["idtipdoc"].'">'.$rowi["destipdoc"].'</option>';
	}
	echo'</select>';
}

?>