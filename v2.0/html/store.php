<?php
	require ('php/conexion.php');
	$query="SELECT id_producto, nombre, precio, stock, marca, tamanio FROM productos";
	$resultado= $conexion->query($query);
?>

<html>
	<head>
		<title>Ultramarinos 2.0</title>
		<link rel="stylesheet" href="style.css" type="text/css"/>
	</head>
	<body>
		<div id="header">
			<h1>LA FRUTERIA EN CASA</h1>
			<form method="POST" action="">
			<input name="salir" type="submit" value="Salir de la sesion"/>
			</form>
			<?php
				if(isset($_POST['salir'])){
					session_destroy();
					header("location:http://localhost/myproject1/v2.0/html/index.html");
				}
			?>
		</div>
			<div id="content">
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
					<input type="submit" value="Cargar tabla">
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
				</div>
			
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

