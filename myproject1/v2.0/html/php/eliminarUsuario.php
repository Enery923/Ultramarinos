<?php 
	require('conexion.php');
	
	$id_usuario=$_GET['id_usuario'];
	$query="DELETE FROM usuarios WHERE id_usuario= '$id_usuario'";
	  
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
				<h1>Usuario eliminado</h1>
				<?php }else{ ?>
				<h1>Error al eliminar usuarios</h1>		
				<?php } ?>		
					<p></p>	
			<a class="button" href="http://localhost/myproject1/v2.0/html/storeUsuarios.php">Volver a tabla</a>
			<p></p>
			<a class="ayuda" href="http://localhost/myproject1/v2.0/html/eliminaAyuda.html">?</a>
		</center>
	</body>
</html>