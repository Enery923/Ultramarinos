<?php 

//Para que no se vean los posibles errores de compilacion
ini_set('display_errors','Off');
ini_set('display_startup_errors','Off');
error_reporting(0);

//Abrimos una sesion
		session_cache_limiter('nocache,private');
		session_name('sesionKiosko');
		session_start();

//declaramos como variables a los campos de texto del formulario.
$nombre=$_POST["userName"];	
$password=$_POST["userPassword"];

function Conectarse(){
	if(!($link=mysql_connect('localhost','root'))){
		echo 'Error conectando a la base de datos.';
		exit();
	}
	if(!mysql_select_db('ultramarinosdb',$link)){
		echo "Error seleccionando la base de datos";
		exit();
	}
	return $link; //variable de conexion
}

$con = Conectarse();
//Cargamos la lista de usuarios que sean equivalentes a los datos introducidos
$query1 = "SELECT * FROM usuarios WHERE usuario='".$nombre."' AND password ='".$password."';";
//Peticion al servidor para recuperar los datos
$result = mysql_query($query1,$con);
$row = mysql_fetch_array($result); // Array con los resultados {id_usuario, usuario, tipo, password}
$nr = mysql_num_rows($result); 


try{
	if($nr == 1){
		switch($row[2]){
			case 1:
					header("location:http://localhost/myproject1/v2.0/html/gestorJefe.php");
					break;//boss
			case 2:
					header("location:http://localhost/myproject1/v2.0/html/storeProducts.php");
					break;//Employee
			case 3:
					header("location:http://localhost/myproject1/v2.0/html/store.php");
					break;//Client
		}
		
	}else{
		echo"<html><head><title>'Error de registro'</title><link rel='stylesheet' href='http://localhost/myproject1/v2.0/html/style.css' type='text/css'/></head><body>";
		echo "Su usuario es incorrecto. Vuelva a intentarlo de nuevo";
		echo "<br/>";
		echo "<a class='button' href='http://localhost/myproject1/v2.0/html/index.html'>Reintentar</a>";
		echo "</body></html>";
	}
}catch(Exception $error){
	mysql_close($con);
}
?>