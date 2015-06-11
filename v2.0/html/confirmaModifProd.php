<?php 
	
	require('conexion.php');
	

	$id_producto=$_POST['id_producto'];
	$nombre=$_POST['nombre'];
	$marca=$_POST['marca'];
	$precio=$_POST['precio'];
	$stock=$_POST['stock'];
	$tamanio=$_POST['tamanio'];
	
	$query = "UPDATE productos SET nombre='$nombre', precio='$precio', stock='$stock', marca='$marca', tamanio='$tamanio' WHERE id_producto= '$id_producto'";
	
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
				<h1>Producto modificado</h1>
				<?php }else{ ?>
				<h1>Error al modificar producto</h1>		
			<?php	} ?>		
			<p></p>	
			<a href="storeProducts.php">Volver a tabla</a>
		</center>
	</body>
</html>	