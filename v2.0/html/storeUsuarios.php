<?php
	
	require ('conexion.php');
	
	$query="SELECT id_usuario, usuario, tipo, password  FROM usuarios";

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
		
		<p></p>
			<a href = "usuariosAyuda.html"> Ayuda </a>
		<p></p>
			<div id="content">
				<a href="nuevoUsuario.php"><b>Nuevo usuario</b></a>
				<p></p>
				
				
				<table id="cat">
				<thead>
					<tr id="first">
					
						<td>
							Usuario
						</td>
						<td>
							Password
						</td>
						<td>
							Tipo
						</td>
						
						<td></td>
						<td></td>
					</tr>
					
				
					<tbody>
						<?php while ($row= $resultado-> fetch_assoc()){?> 
							<tr id="second">
								<td><?php echo $row ['usuario'] ;?></td>
								<td><?php echo $row ['password'] ;?></td>
								<td><?php echo $row ['tipo'] ;?></td>
								
								<td>
									
									<a href="modificarUsuario.php?id_usuario=<?php echo $row['id_usuario'];?>">Modificar</a>
								</td>
								<td>
									
									<a href="eliminarUsuario.php?id_usuario=<?php echo $row['id_usuario'];?>">Eliminar</a>
								
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

