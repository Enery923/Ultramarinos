<?php
	require ('php/backup.php');
	require ('php/conexion.php');
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
			<h1 class="titulo2">LA FRUTERIA EN CASA</h1></a>
		</div>
			<div id="butOv">
			<a class="button" href="php/nuevoProducto.php"><b>Nuevo producto</b></a>		
				<div id="catFruit">
					<form method="POST" action="">
					 <select name="catFruit">
								<option value="Default">Escoge la categor&iacutea</option>
								<!--CATEGORIAS DE LOS PRODUCTOS-->
								<option value="0">Todos</option>
								<option value="1">Congelados</option>
								<option value="2">L&aacutecteos </option>	
								<option value="3">Aceites</option>	
					</select> 
					<input class="butLoad" type="submit" value="Cargar tabla">
					</form>
					<?php
						if(isset($_POST['catFruit'])){
								if($_POST['catFruit'] == 0){
									$query="SELECT id_producto, nombre, precio, stock, marca, tamanio FROM productos";
									$resultado= $conexion->query($query);
								}else{
									$idCat = $_POST['catFruit'];
									//echo "$idCat";
									$query1="SELECT id_producto, nombre, precio, stock, marca, tamanio FROM productos WHERE id_categoria='".$idCat."';";
									$resultado= $conexion->query($query1);
								}
						}
				?>
				</div><!--cierra catFruit-->
				</div><!--cierra butOver the table-->
				<table id="cat">
				<thead>
					<tr id="first">
						<td>Producto</td>
						<td>Precio</td>
						<td>Unidades/Stock</td>
						<td>Marca</td>
						<td>Tama&ntildeo</td>
						<td></td>
						<td></td>
					</tr>
					<tbody>
						<?php while ($row= $resultado-> fetch_assoc()){?> 
							<tr>
								<td><?php echo $row ['nombre'] ;?></td>
								<td><?php echo $row ['precio'] ;?></td>
								<td><?php echo $row ['stock'] ;?></td>
								<td><?php echo $row ['marca'] ;?></td>
								<td><?php echo $row ['tamanio'] ;?></td>
								<td>
									<a class="button" href="php/modificarProducto.php?id_producto=<?php echo $row['id_producto'];?>">Modificar</a>
								</td>
								<td>
									<a class="button" href="php/eliminarProducto.php?id_producto=<?php echo $row['id_producto'];?>">Eliminar</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>	
				</table>
			
		<div id="footer">
			
			<form method="POST" action="">
			<input class="butSal" name="salir" type="submit" value="Salir de la sesion"/>
			</form>
			<?php
				if(isset($_POST['salir'])){
					backup::doBackup();
					session_destroy();
					header("location:http://localhost/myproject1/v2.0/html/index.html");
				}
			?>
			<a class="ayuda" href = "ayuda/productosAyuda.html"> ? </a>
		</div>
		
	</body>
</html>

