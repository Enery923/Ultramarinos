<?php
	require ('php/backup.php');
	require ('php/conexion.php');
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
			<a href="gestorJefe.php"><h1>LA FRUTERIA EN CASA</h1></a>
			<a href = "http://localhost/myproject1/v2.0/html/ayuda/usuariosAyuda.html"> Ayuda </a>
			<form method="POST" action="">
			<input name="salir" type="submit" value="Salir de la sesion"/>
			</form>
			<?php
				if(isset($_POST['salir'])){
					backup::doBackup();
					session_destroy();
					header("location:http://localhost/myproject1/v2.0/html/index.html");
				}
			?>
		</div>
			<div id="content">
				<div id="catUser">
					<form method="POST" action="">
					 <select name="catUser">
								<option value="Default">Escoge una categor&iacutea</option>
								<!--CATEGORIAS DE LOS PRODUCTOS-->
								<option value="0">Todos</option>
								<option value="2">Empleados</option>
								<option value="3">Clientes</option>	
					</select> 
					<input type="submit" value="Cargar tabla">
					</form>
					<?php
						if(isset($_POST['catUser'])){
								if($_POST['catUser'] == 0){
									$query="SELECT id_usuario, usuario, tipo, password  FROM usuarios";
									$resultado= $conexion->query($query);
								}else{
									$idUser = $_POST['catUser'];
									$query1="SELECT id_usuario, usuario, tipo, password  FROM usuarios WHERE tipo='".$idUser."';";
									$resultado= $conexion->query($query1);
								}
						}
				?>
			
				<a href="http://localhost/myproject1/v2.0/html/php/nuevoUsuario.php"><b>Nuevo usuario</b></a>				
				<table id="cat">
				<thead>
					<tr id="first">
						<td>Usuario</td>
						<td>Password</td>
						<td>Tipo</td>
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
									<a href="http://localhost/myproject1/v2.0/html/php/modificarUsuario.php?id_usuario=<?php echo $row['id_usuario'];?>">Modificar</a>
								</td>
								<td>
									<a href="http://localhost/myproject1/v2.0/html/php/eliminarUsuario.php?id_usuario=<?php echo $row['id_usuario'];?>">Eliminar</a>
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

