<?

class dataBase{
	//me conecto a la base de datos
	function connectDB(){
		//hallo la ruta de la carpeta seguridad para obtener el archivo con los datos de conexión
		# Windows: c:/ServidoresLocales/Apache/htdocs
		$path=$_SERVER['DOCUMENT_ROOT'];
		//echo $path; /var/wwww)
		//crear la carpeta seguridad y dentro de ella el mysql.inc.php y el htacces si hace falta
		//comprobar si hay que cambiar configuraciones
		//$parts=explode('/',$path);
		//$parts[sizeof($parts)-1]="";
		//$finalPath=implode("/",$parts)."seguridad/";
		//include($finalPath."mysql.inc.php");
		include("/var/lib/mysql/10569937caa2b6913ca7f7b533c2d4be/mysql.inc.php");
		print($mysql_login);
		//con esos datos hago la conexión a la base de datos
		 if($c=mysqli_connect("localhost","root","sekret")){//$mysql_server,$mysql_login,$mysql_pass)){
		 	//Se selecciona la base de datos
			mysqli_select_db ($c, "Kiosko");
			return $c;
		 }else{
			print "<br> Hasn't established connection!!<br>";
		 }
	}
	
	
	//me desconecto de la base de datos
	function disconnectDB($connection){
		if(mysqli_close($connection)){
			//desconectado
		}else{
			print("Error close connection, maybe i would be opened<br>");
		}
	 }
	  
	  
	  
	 //compruebo que existe la base de datos
	function checkBase($name, $connection){
		$exist=mysqli_select_db ( $connection , $name);
		return $exist;
	}
	
	
	
	//hago una consulta a la base de datos y devuelvo el resultado
	function search($sentence){
		//establezco la base de datos
		$base="Kiosko";
		//me conecto a la base de datos
		$connection=dataBase::connectDB();
		//compruebo que existe la base de datos
		if(dataBase::checkBase($base, $connection)){
			//selecciono la base de datos
			mysqli_select_db ($base, $connection);
			$search=mysqli_query($sentence);
			return $search;
			dataBase::disconnectDB($connection);
		}else{
			print("Fatal error, database doesn't existed!!!");
			return false;
		}
	}
	
	//ejecuto sentencia insert delete o update
	function modification ($sentence){
		//establezco la base de datos
		$base="Kiosko";
		//me conecto a la base de datos
		$connection=dataBase::connectDB();
		//compruebo que existe la base de datos
		if(dataBase::checkBase($base, $connection)){
			//selecciono la base de datos
			mysqli_select_db ($base, $connection);
			mysqli_query($sentence);
			$error= mysqli_errno($connection);
			dataBase::disconnectDB($connection);
			return $error;
		}else{
			return -1;
		}
	}
	
	
	//ejecuto serie de sentencias con begin/commit/rollback
	function transaction2($sentence1,$sentence2){
		//establezco la base de datos
		$base="Kiosko";
		//me conecto a la base de datos
		$connection=dataBase::connectDB();
		//compruebo que existe la base de datos
		if(dataBase::checkBase($base, $connection)){
			//selecciono la base de datos
			mysqli_select_db ($base, $connection);
			mysqli_query("BEGIN",$connection);
			mysqli_query($sentence1);
			$error1=mysqli_errno($connection);
			print(mysqli_error($connection));
			
			mysqli_query($sentence2);
			$error2=mysqli_errno($connection);
			
			if($error1==0 AND $error2==0){
				mysqli_query("COMMIT",$connection);
				dataBase::disconnectDB($connection);
				return 0;
			}else{
				mysqli_query("ROLLBACK",$connection);
				dataBase::disconnectDB($connection);
				
				if(!$error1==0){
					return $error1;
				}else{
					return $error2;
				}
			}
			
		}else{
			return -1;
		}
	}
	
	
	//ejecuto serie de sentencias con begin/commit/rollback
	function transaction3($sentence1, $sentence2, $sentence3){
		//establezco la base de datos
		$base="Kiosko";
		//me conecto a la base de datos
		$connection=dataBase::connectDB();
		//compruebo que existe la base de datos
		if(dataBase::checkBase($base, $connection)){
			//selecciono la base de datos
			mysqli_select_db ($base, $connection);
			mysqli_query("BEGIN",$connection);
			mysqli_query($sentence1);
			$error1=mysql_errno($connection);
			
			mysqli_query($sentence2);
			$error2=mysqli_errno($connection);
			
			mysqli_query($sentence3);
			$error3=mysqli_errno($connection);
			
			if($error1==0 AND $error2==0 AND $error3==0){
				mysqli_query("COMMIT",$connection);
				dataBase::disconnectDB($connection);
				return 0;
			}else{
				mysqli_query("ROLLBACK",$connection);
				dataBase::disconnectDB($connection);
				
				if(!$error1==0){
					return $error1;
				}else{
					if(!$error2==0){
						return $error2;
					}else{
						return $error3;
					}
				}
			}
			
		}else{
			return -1;
		}
	}
	
	//ejecuto serie de sentencias con begin/commit/rollback
	function transaction4($sentence1, $sentence2, $sentence3, $sentence4){
		//establezco la base de datos
		$base="Kiosko";
		//me conecto a la base de datos
		$connection=dataBase::connectDB();
		//compruebo que existe la base de datos
		if(dataBase::checkBase($base, $connection)){
			//selecciono la base de datos
			mysqli_select_db ($base, $connection);
			mysqli_query("BEGIN",$connection);
			mysqli_query($sentence1);
			$error1=mysqli_errno($connection);
			
			mysqli_query($sentence2);
			$error2=mysqli_errno($connection);
			
			mysqli_query($sentence3);
			$error3=mysqli_errno($connection);
			
			mysqli_query($sentence4);
			$error4=mysqli_errno($connection);
			
			if($error1==0 AND $error2==0 AND $error3==0 AND $error4==0){
				mysqli_query("COMMIT",$connection);
				dataBase::disconnectDB($connection);
				return 0;
			}else{
				mysqli_query("ROLLBACK",$connection);
				dataBase::disconnectDB($connection);
				
				if(!$error1==0){
					return $error1;
				}else{
					if(!$error2==0){
						return $error2;
					}else{
						if(!$error3==0){
							return $error3;
						}else{
							return $error4;
						}
					}
				}
			}
			
		}else{
			return -1;
		}
	}
}
?>
