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
		<link rel="stylesheet" href="style.css" type="text/css"/>
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
			<a href="storeUsuarios.php">Volver a tabla</a>
			<p></p>
			<a href = "confirmarAyuda.html"> Ayuda </a>
		</center>
	</body>
</html>	