<?php 
	require('conexion.php');

	$id_usuario=$_POST['id_usuario'];
	$usuario=$_POST['usuario'];
	$password=$_POST['password'];
	$tipo=$_POST['tipo'];
	
	$query = "UPDATE usuarios SET usuario='$usuario', tipo='$tipo', password='$password' WHERE id_usuario= '$id_usuario'";
	$resultado=$conexion->query($query);
	
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
		<center>	
			
			<?php if($resultado>0){ ?>
				<h1>Usuario modificado</h1>
				<?php }else{ ?>
				<h1>Error al modificar usuario</h1>		
			<?php	} ?>		
			<p></p>	
			<a class="button" href="http://localhost/myproject1/v2.0/html/storeUsuarios.php">Volver a tabla</a>
			
			<a class="ayuda" href = "http://localhost/myproject1/v2.0/html/confirmarAyuda.html"> ?</a>
		</center>
	</body>
</html>	