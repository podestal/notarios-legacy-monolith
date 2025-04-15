<?php 
include ('conexion.php');
/*
$consulta=mysql_query("SELECT b.`detbien`, b.`kardex`,p.`itemmp`  AS patri_item,b.`itemmp` AS bien_item  
FROM detallebienes b 
INNER JOIN patrimonial p ON b.`kardex`=p.`kardex`
WHERE p.`itemmp`<>b.`itemmp` AND b.`itemmp`='' ORDER BY b.`detbien` ASC",$conn) or die (mysql_error());

echo "<table border='1'><tr><td>CODIGO<td>KARDEX<td>PATRI<td>BIEN<TD>CONSULTA SQL</tr>";
while ($row=mysql_fetch_array($consulta)){
	$patri=$row['patri_item'];
	
	echo "<tr><td>".$row['detbien']."</td><td>".$row['kardex']."</td><td>".$row['patri_item']."</td><td>".$row['bien_item']."</td>";
	
	$var="update detallebienes set itemmp='".$patri."' where detbien='".$row['detbien']."'";
	
	mysql_query($var,$conn);
	echo "<td>$var</td></tr>";
	
	mysql_query();
}
echo "</table>";*/


$consulta=mysql_query("SELECT p.`itemmp`,p.`kardex`,p.`idtipoacto` 
FROM patrimonial p",$conn) or die (mysql_error());

echo "<table border='1'><tr><tH>CODIGO DEL BIEN<tH>KARDEX<tH>ACTO<tH>ITEM PATRIMONIAL<TH>CONSULTA SQL</tr>";
while ($row=mysql_fetch_array($consulta)){
	
	$consulta2=mysql_query("SELECT detbien,kardex,idtipacto FROM `detallebienes` where kardex='".$row['kardex']."' and itemmp='' order by kardex",$conn) or die (mysql_error());

	while ($row2=mysql_fetch_array($consulta2)){
		
		if($row2['idtipacto']==$row['idtipoacto']){
			$var="update detallebienes set itemmp='".$row['itemmp']."' where detbien='".$row2['detbien']."'";
			mysql_query($var,$conn);
				echo "<tr><td>".$row2['detbien']."</td>";
				echo "<td>".$row2['kardex']."</td>";
				echo "<td>".$row2['idtipacto']."</td>";
				echo "<td>".$row['itemmp']."</td>";
				echo "<td>$var</td></tr>";
			
		}
		
	}
}/*
	$patri=$row['patri_item'];
	
	echo "<tr><td>".$row['detbien']."</td><td>".$row['kardex']."</td><td>".$row['patri_item']."</td><td>".$row['bien_item']."</td>";
	
	
	
	mysql_query($var,$conn);
	echo "<td>$var</td></tr>";
	
	mysql_query();
}*/
echo "</table>";
?>