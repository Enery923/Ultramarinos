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
			<h1>LA FRUTERIA EN CASA</h1>
		</div>
			<div id="content">
				<div id="catFruit">
					 <select id="catFruit">
						  <option value="Default">Escoge la categor&iacutea</option>
						  
						  <!--CATEGORIAS DE LOS PRODUCTOS-->
						  <option value="Congelados">Congelados</option>
						  <option value="Lacteos">L&aacutecteos </option>
					</select> 
				</div>
			
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
							Unidades/Stock
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
							</tr>
						<?php } ?>
					</tbody>	
				</table>
			</div>
		<div id="footer">
		</div>
		
	</body>
</html>

