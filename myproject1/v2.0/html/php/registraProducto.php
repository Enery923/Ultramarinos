<?php 
	
	require('conexion.php');
	
	$nombre=$_POST['nombre'];
	$marca=$_POST['marca'];
	$precio=$_POST['precio'];
	$stock=$_POST['stock'];
	$tamanio=$_POST['tamanio'];
	$categoria=$_POST['categoria'];
	
	$query="INSERT INTO productos (nombre, precio, stock, marca, tamanio,id_categoria) VALUES ('$nombre','$precio','$stock', '$marca', '$tamanio','$categoria')";
	
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
				<h1>Producto registrado</h1>
			<?php }else{ ?>
				<h1>Error al registrar producto</h1>	
						
			<?php	} ?>		
				
			<a class="button" href="http://localhost/myproject1/v2.0/html/storeProducts.php">Volver a tabla</a>
			
			<a class="ayuda" href="http://localhost/myproject1/v2.0/html/ayuda/registroAyuda.html">Ayuda</a>
		</center>
	</body>
</html>	