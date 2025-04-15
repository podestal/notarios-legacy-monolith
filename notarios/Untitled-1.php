<form method="get" action="holaaa.php">
<input type="submit" name="sub">
</form>

<?php 

if(isset($_POST['sub'])){
$variable=$_POST['variable'];
ucwords($variable);
echo "hola".ucwords($variable);
}
?>
</body>
</html>