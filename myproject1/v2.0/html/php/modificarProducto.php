<?php
	require('conexion.php');
	$id_producto=$_GET['id_producto'];
	$query="SELECT nombre, precio, stock, marca, tamanio FROM productos WHERE id_producto='$id_producto'";
	$resultado=$conexion->query($query);
	$row=$resultado->fetch_assoc();
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
		
		<form name = "producto_modificado" method = "POST" action = "confirmaModifProd.php">
			</div>
			<a class="ayuda" href='http://localhost/myproject1/v2.0/html/ayuda/modificarProdAyuda.html'>?</a>
				<div id="content">
					<table id="cat">
						 <tr id="first">
							<input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
							<td><b>Nombre del producto</b></td>
							<td><input type= "text" name = "nombre" value="<?php echo $row['nombre']; ?>" /></td>
						 </tr>
						 
						 <tr id="first">
							<td><b>Precio</b></td>
							<td><input type= "text" name = "precio" value="<?php echo $row['precio']; ?>"/></td>
						 </tr>
						 
						 <tr id="first">
							<td><b>Unidades/Stock</b></td>
							<td><input type= "text" name = "stock" value="<?php echo $row['stock']; ?>"/></td>
						 </tr>
						 
						 <tr id="first"> 
							<td><b>Marca</b></td>
							<td><input type= "text" name = "marca" value="<?php echo $row['marca']; ?>"/></td>
						 </tr>
						 
						 <tr id="first">
							<td><b>Tama&ntildeo</b></td>
							<td><input type= "text" name = "tamanio" value="<?php echo $row['tamanio']; ?>"/></td>
						 </tr>
						
						   <tr id="first">
						<td><b>Categor&iacutea</b></td>
						<td><select name="categoria">
								<option value="1">Congelados</option>
								<option value="2">L&aacutecteos </option>	
								<option value="3">Aceites</option>	
								</select> </td>
					 </tr>
						 
						 <tr id="first">
							<td colspan = "2"> <center><input type ="submit" name = "enviar" value = "Modificar producto" /></center></td>
						 </tr>
			
					</table>
				</div>
				<div id="footer">
				</div>
		</form>
	<body>
<html>