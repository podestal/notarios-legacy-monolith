
   <?php 
include("../../conexion.php");
$idCliente=$_POST['idCliente'];

$query = "SELECT * FROM cliente WHERE idcliente='$idCliente'";
$result = mysql_query($query, $conn) or die(mysql_error());
$row = mysql_fetch_assoc($result);
echo json_encode($row);
?>

