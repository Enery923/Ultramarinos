<?php 
	
	require('conexion.php');
	$id_producto=$_GET['id_producto'];
	$query="DELETE FROM productos WHERE id_producto= '$id_producto'";
	  
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
				<h1>Producto eliminado</h1>
				<?php }else{ ?>
				<h1>Error al eliminar producto</h1>		
				<?php } ?>		
					<p></p>	
			<a href="http://localhost/myproject1/v2.0/html/storeProducts.php">Volver a tabla</a>
			<p></p>
			<a href="http://localhost/myproject1/v2.0/html/ayuda/eliminaAyuda.html">Ayuda</a>
		</center>
	</body>
</html>