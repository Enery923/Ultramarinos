<?php

$servidor = "localhost"; //el servidor que utilizaremos, en este caso será el localhost

$usuario = "root";

$password = "";

$BD = "ultramarinosdb"; //El nombre de la base de datos

 

/*Aquí abrimos la conexión en el servidor. */

$conexion = new mysqli($servidor, $usuario, $password, $BD);

 

/* Aquí preguntamos si la conexión no pudo realizarse, de ser así lanza un mensaje en la pantalla con el siguiente texto "No pudo conectarse:"

*/

if (mysqli_connect_errno()) {

  
   
   echo 'No pudo conectarse: ' , mysqli_connect_error();
   exit();

}/*else{

//La siguiente linea no es necesaria al momento de programar, simplemente la pondremos ahora para poder observar que la conexión ha sido realizada

echo 'Conectado  satisfactoriamente al servidor <br />';

}*/


?>
