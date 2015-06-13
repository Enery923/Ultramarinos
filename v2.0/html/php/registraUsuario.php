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
		<link rel="stylesheet" href="http://localhost/myproject1/v2.0/html/style.css" type="text/css"/>
	</head>
	<body>
		<div id="header">
			<h1>LA FRUTERIA EN CASA</h1>
		</div>
		<center>	
			
			<?php if($resultado==1){ ?>
				<h1>Usuario registrado</h1>
				<?php }else{ ?>
				echo "$resultado"
				<h1>Error al registrar usuario</h1>		
			<?php	} ?>		
			<p></p>	
			<a href="http://localhost/myproject1/v2.0/html/storeUsuarios.php">Volver a tabla</a>
			<p></p>
			<a href="http://localhost/myproject1/v2.0/html/ayuda/registroAyuda.html">Ayuda</a>
		</center>
	</body>
</html>	