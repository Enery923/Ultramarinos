<?php
	
	require('conexion.php');
	$id_usuario=$_GET['id_usuario'];
	$query="SELECT usuario, tipo, password FROM usuarios WHERE id_usuario='$id_usuario'";
	
	$resultado=$conexion->query($query);	
	$row=$resultado->fetch_assoc();
?>

<html>
	<head>
		<title>
			Fruiter
		</title>
		<link rel="stylesheet" href="http://localhost/myproject1/v2.0/html/style.css" type="text/css"/>
	</head>
	<body>
		<div id="header">
			<h1>LA FRUTERIA EN CASA</h1>
		</div>
		
		<form name = "usuario_modificado" method = "POST" action = "http://localhost/myproject1/v2.0/html/php/confirmaModifUsuario.php">
			</div>
			<a class="ayuda" href="http://localhost/myproject1/v2.0/html/modificarUsuAyuda.html">?</a>
				<div id="content">
					<table id="cat">
						 <tr id="first">
							<input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
							<td><b>Usuario</b></td>
							<td><input type= "text" name = "usuario" value="<?php echo $row['usuario']; ?>" /></td>
						 </tr>
						 
						 <tr id="first">
							<td><b>Password</b></td>
							<td><input type= "password" name = "password" value="<?php echo $row['password']; ?>"/></td>
						 </tr>
						 
						 <tr id="first">
							<td><b>Tipo</b></td>
							<td><input type= "text" name = "tipo" value="<?php echo $row['tipo']; ?>"/></td>
						 </tr>

						 <tr id="first">
							<td colspan = "2"> <center><input type ="submit" name = "enviar" value = "Modificar usuario" /></center></td>
						 </tr>
			
					</table>
				</div>
				<div id="footer">
				</div>
		</form>
	<body>
<html>