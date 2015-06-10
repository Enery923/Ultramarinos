<?php 
//Conexion con la base de datos.
$conexion=@mysql_connect("localhost","root","root");
echo "caca 1";
if (!($conexion)){
echo 'No se puede realizar la conexion con la base de datos.';
}
echo "caca 2";
//Seleccion de la base de datos.
mysql_select_db("ultramarinosdb");

//declaramos como variables a los campos de texto del formulario.
$nombre=$_GET["userName"];	
$password=$_GET["userPassword"];
echo "caca 3";
//Consulta del usuario y el password
$query="SELECT usuario,password FROM usuarios WHERE usuario='$nombre' and password='$password' ";
$rs=mysql_query($query); 
$row=mysql_fetch_object($rs); 
$nr = mysql_num_rows($rs); 

//Si existe el usuario lo va a redireccionar a la pagina de Bienvenida.

if($nr == 1){ 
 header ("Location:bossPage.php"); 

}

//Si no existe lo va a enviar al login otra vez.
else if($nr <= 0) { 
  header("Location:storePeople.html"); 
}   
?>