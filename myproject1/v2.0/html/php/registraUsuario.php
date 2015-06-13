<?php 
	
	require('conexion.php');
	$usuario=$_POST['usuario'];
	$password=$_POST['password'];
	$tipo=$_POST['tipo'];
	
	$query3="INSERT INTO usuarios (usuario, password, tipo) VALUES ('$usuario','$password','$tipo');";
	$resultado=$conexion->query($query3);

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
			<h1 class="titulo2">LA FRUTERIA EN CASA</h1>
		</div
		<?php
		echo $usuario;
		echo "$password";
		echo "$tipo";
		?>
		<center>	
			<?php if($resultado>0){ ?>
				<h1>Usuario registrado</h1>
				<?php }else{ ?>
				<h1>Error al registrar usuario</h1>		
			<?php	} ?>		
				
			<a class="button" href="http://localhost/myproject1/v2.0/html/storeUsuarios.php">Volver a tabla</a>
			<a class="ayuda" href="http://localhost/myproject1/v2.0/html/ayuda/registroAyuda.html">?</a>
		</center>
	</body>
</html>	