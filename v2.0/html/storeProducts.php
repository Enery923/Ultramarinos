<?php
	
	require ('conexion.php');
	
	$query="SELECT id_producto, nombre, precio, stock, marca, tamanio FROM productos";

	$resultado= $conexion->query($query);
	
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
			<div id="content">
				<div id="catFruit">
					 <select id="catFruit">
						  <option value="Default">Escoge la categor&iacutea</option>
						  
						  <!--CATEGORIAS DE LOS PRODUCTOS-->
						  <option value="Empleados">Empleados</option>
						  <option value="Stock">Almac&eacuten</option>
					</select> 
				</div>
			
				<a href="nuevoProducto.php"><b>Nuevo producto</b></a>
				<p></p>
				
				
				<table id="cat">
				<thead>
					<tr id="first">
					
						<td>
							Producto
						</td>
						<td>
							Precio
						</td>
						<td>
							Unidades disponibles/Stock
						</td>
						<td>
							Marca
						</td>
						<td>
							Tamaño
						</td>
						<td></td>
						<td></td>
					</tr>
					
				
					
					<tbody>
						<?php while ($row= $resultado-> fetch_assoc()){?> 
							<tr id="second">
								<td><?php echo $row ['nombre'] ;?></td>
								<td><?php echo $row ['precio'] ;?></td>
								<td><?php echo $row ['stock'] ;?></td>
								<td><?php echo $row ['marca'] ;?></td>
								<td><?php echo $row ['tamanio'] ;?></td>
								
								<td>
									<a href="modificarProducto.php?id_producto=<?php echo $row['id_producto'];?>">Modificar</a>
								</td>
								<td>
									<a href="eliminarProducto.php?id_producto=<?php echo $row['id_producto'];?>">Eliminar</a>
								</td>
							</tr>
							
						<?php } ?>
					</tbody>	
				</table>
			</div>
		<div id="footer">
		</div>
		
	</body>
</html>

