<?php 
	
	require('conexion.php');
	
	
	$nombre=$_POST['nombre'];
	$marca=$_POST['marca'];
	$precio=$_POST['precio'];
	$stock=$_POST['stock'];
	$tamanio=$_POST['tamanio'];
	
	$query="INSERT INTO productos (nombre, precio, stock, marca, tamanio) VALUES ('$nombre','$precio','$stock', '$marca', '$tamanio')";
	
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
				<h1>Producto registrado</h1>
				<?php }else{ ?>
				<h1>Error al registrar producto</h1>		
			<?php	} ?>		
			<p></p>	
			<a href="storeProducts.php">Volver a tabla</a>
		</center>
	</body>
</html>	