<?php 
	
	require('conexion.php');
	
	
	$usuario=$_POST['usuario'];
	$password=$_POST['password'];
	$tipo=$_POST['tipo'];
	
	
	$query="INSERT INTO usuarios (usuario, password, tipo) VALUES ('$usuario','$password','$tipo')";
	
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
			<a href="index.html"><h1>LA FRUTERIA EN CASA</h1></a>
		</div>
		<center>	
			
			<?php if($resultado>0){ ?>
				<h1>Usuario registrado</h1>
				<?php }else{ ?>
				<h1>Error al registrar usuario</h1>		
			<?php	} ?>		
			<p></p>	
			<a href="storeUsuarios.php">Volver a tabla</a>
		</center>
	</body>
</html>	