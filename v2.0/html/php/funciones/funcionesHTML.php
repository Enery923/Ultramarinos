<?
require_once($_SERVER['DOCUMENT_ROOT'] ."/practicaI/10569937caa2b6913ca7f7b533c2d4be/php/Funciones/session.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/practicaI/10569937caa2b6913ca7f7b533c2d4be/php/Funciones/clases.php");

class estilo{
	function css(){
			print("<link href='/v2.0/html/estilo.css' rel='stylesheet'/>");
	}
}

class codigoHtml{
	//codigo para los meta tags
	function metas(){
		?>
			<meta name="Keywords" content="kiosko, ultramarinos, productos, compra" >
			<meta name="Description" content="Ultramarinos virtual" >
			<meta name="Robots" content="all" >
			<meta http-equiv="Window-target" content="_top" >
			<meta name="author" content="Unknown" >
			<meta name="date" content="2015-06-13T00:27:02+0200" >
			<meta name="Copyright" CONTENT="2015 Todos los derechos reservados.">
			<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?
	}
	
	//Escribo el head de la página y su cabecera
	function inicioHtml(){
		//abro sesión
  		Session::abrirSession();	
		
		print("<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
				<html>
					<head>");
						//incluyo el codigo javascript
						print(codigoHtml::metas());
						estilo::css();
						print("<title>Ultramarinos virtual</title>
							</head>
							<body>");
					//escribo la cabecera
					codigoHtml::header();
							
	}


	//escribo la cabecera
	function header(){
		print("
			<div id='header'>
			<h1>Ultramarinos Virtual</h1>
			<ul>
   			<li class='first'><a href='/v2.0/html/php/index.php?".session_name()."=".session_id()."' accesskey='1'>Inicio</a></li>
    			<li><a href='/v2.0/html/php/acercaDe.php?".session_name()."=".session_id()."' accesskey='2'>Acerca de</a></li>
    			
		");
		//<li><a href='#' accesskey='3'>Contacto</a></li>
		
		if($_SESSION[IS_LOGGED]==true){
			print("<li><a href='/v2.0/html/php/datosPersonales.php?".session_name()."=".session_id()."' accesskey='4'>");
			$user=$_SESSION[USER];
			print(htmlentities("Hola ".$user->getNameUser()));
			print("</a></li>");
   		print("<li><a href='/v2.0/html/php/deslogueo.php?".session_name()."=".session_id()."' accesskey='5'>Cerrar Sesión</a></li>");
   		
		}else{
			print("<li><a href='/v2.0/html/php/login.php?".session_name()."=".session_id()."' accesskey='4'>".htmlentities("Iniciar sesión")."</a></li>");
			print("<li><a href='/v2.0/html/php/registro.php?".session_name()."=".session_id()."' accesskey='5'>".htmlentities("Registrarse")."</a></li>");
		}
		//Esta linea deberiamos suprimirla si no tenemos servicio de compra online
		print("<li><a href='#' accesskey='6'>Cesta <img src='/practicaI/10569937caa2b6913ca7f7b533c2d4be/images/basket.png' alt='' /></a></li>");
		print("</ul>
			</div>");
			
	}
	
	function footer(){
	print("<div id='footer'>
		<p>Copyright &copy; design 2006 Primitive Element. Designed by <a href='http://www.freecsstemplates.org/'><strong>Free CSS Templates</strong></a>
		<br>Downloaded from <a href='http://all-free-download.com/free-website-templates/'>free website templates</a> and modified</p></div></body>
		</html>");	
	}
	
/*Estas funciones no nos sirven para nada en realidad, aqui es donde creariamos la funcion que hace aparecer las tablas en funcion de la categoria
		function infoItem($data, $type){
		print("<div class='info'>");
		print("<img src='/practicaI/10569937caa2b6913ca7f7b533c2d4be/imagesSticker/");
		if($type==CROMO){
			print(htmlentities($data->getImage()));
			print("' alt='' />");
			print("<p>Nombre: ".htmlentities($data->getNombre())."</p>");
			print("<p>".htmlentities("Perteneciente a la colección: ").$data->getNameCollection()."</p>");
			print("<p>".htmlentities("Descripción: ").htmlentities($data->getTexto())."</p>");
			print("<p>Precio: ".$data->getPrice()."€<br>Stock: ".$data->getStock()."</p>");
		}else{
			print(htmlentities($data->getImage()));
			print("' alt='' />");
			print("<p>".htmlentities($data->getCollectionName())."</p>");
			print("<p>".htmlentities($data->getTexto())."</p>");
			print("<p>Número de cromos: ".htmlentities($data->getNumberSticker())."</p>");
			print("<p>Precio: ".$data->getPrice()."€ <br>Stock: ".$data->getStock()."</p>");
		}
		print("</button>");
		print("</form>");
		print("<form>"); //informacion para cristofer
		print('<input class="button" type="button" value="Comprar" />');
		print("</form>");
		print("</div>");
	}
	
	
	function itemList($data, $type){
		print("<div class='itemList'>");
		print('<form method="POST" action="');
		print("/practicaI/10569937caa2b6913ca7f7b533c2d4be/php/info.php");
		print('?'. session_name().'='. session_id().'">');
		print('<button type="submit">');
		print("<input type='hidden' name='id' value='".$data->getId()."' />");
		print("<input type='hidden' name='type' value='".$type."' />");		
		
		print("<img src='/practicaI/10569937caa2b6913ca7f7b533c2d4be/imagesSticker/");
		if($type==CROMO){
			print(htmlentities($data->getImage()));
			print("' alt='' />");
			print("<p>".htmlentities($data->getNombre())."</p>");
			print("<p>".htmlentities("Colección: ").$data->getNameCollection()."</p>");			
			print("<p>Precio: ".$data->getPrice()."€ (Stock: ".$data->getStock().")</p>");
		}else{
			print(htmlentities($data->getImage()));
			print("' alt='' />");
			print("<p>".htmlentities($data->getCollectionName())."</p>");
			print("<p>Cromos: ".htmlentities($data->getNumberSticker())."</p>");
			print("<p>Precio: ".$data->getPrice()."€ (Stock: ".$data->getStock().")</p>");
		}
		print("</button>");
		print("</form>");
		print("<form>"); //informacion para cristofer
		print('<input class="button" type="button" value="Comprar" />');
		print("</form>");
		print("</div>");
		
	}
	

	function orderBox($array, $action, $type){
		print("<form class='boxOrder' method='POST' action='");
		print($action);
		print("?". session_name()."=". session_id()."'>");
		print('Ordenar por: ');
		print('<select name="orderOption">');
		$num=count($array);
		for($i=0; $i<$num; $i++) {
   		print('<option value="');
   		print($array[$i]);
   		print('">');
   		print($array[$i]);
   		print('</option>');
   	}
		print('</select>');
		print("<input type='hidden' name='type' value='");
		print($type);
		print("' />");
		print('<input type="submit" value="Ordenar" />');
		print('</form>');
		
	}
	
	function listStickCollection($list, $page, $totalPages, $action, $type, $id){
		$num=count($list);
		for($i=0; $i<$num; $i++) {
				CodigoHtml::itemList($list[$i], $type);
		}
		
		print('<form class="numerationPage" method="POST" action="');
		print($action);
		print('?'. session_name().'='. session_id().'">');
		print('<input type="submit" name="page" value="Anterior página" />');
		print('<input type="hidden" name="previousPage" value="');
		print($page-1);
		print('" />');
		
		print('<input type="hidden" name="id" value="');
		print($id);
		print('" />');

		$init=0;
		$final=$totalPages;
		if($totalPages>15){
			if(($page+8)>$final){
				$init=$final-15;
			}else{
				$init=$page-7;
				$final=$page+8;
			}		
		}	
		
		for($j=$init; $j<$final; $j++){
			if($j==$page){
				print('<input class="actualPage"  type="submit" name="page" value="');
			}else{
				print('<input type="submit" name="page" value="');
			}
			print($j+1);
			print('" />');
		}
		print("<input type='hidden' name='type' value='");
		print($type);
		print("' />");
		print('<input type="hidden" name="nextPage" value="');
		print($page+1);
		print('" />');
		print('<input type="submit" name="page" value="Siguiente página" />');
		print('</form>');
		
	}
	
	function listManager($list, $page, $totalPages, $action, $type, $id){
		$num=count($list);
		for($i=0; $i<$num; $i++) {
				CodigoHtml::itemListManager($list[$i], $type);
		}
		
		//Imprimimos la colleccion de agregado
		if ($type == COLECCION) {
			print("<div class='itemList'>");
			print('<form method="POST" action="');
			print("/practicaI/10569937caa2b6913ca7f7b533c2d4be/php/Administrador/manageCollection.php");
			print('?'. session_name().'='. session_id().'">');
			print('<button type="submit">');
			print("<input type='hidden' name='id' value='-1' />");
			print("<input type='hidden' name='type' value='".COLECCION."' />");		
			
			print("<img src='/practicaI/10569937caa2b6913ca7f7b533c2d4be/images/addCollection.png' alt='' />");
			print("<p>Agregar coleción</p>");
			print("</button>");
			print("</form>");
			print("</div>");
		} else {
			print("<div class='itemList'>");
			print('<form method="POST" action="');
			print("/practicaI/10569937caa2b6913ca7f7b533c2d4be/php/Administrador/manageCromo.php");
			print('?'. session_name().'='. session_id().'">');
			print('<button type="submit">');
			print("<input type='hidden' name='id' value='-1' />");
			print("<input type='hidden' name='type' value='".CROMO."' />");		
			print("<input type='hidden' name='collection' value='".$id."' />");
			print("<img src='/practicaI/10569937caa2b6913ca7f7b533c2d4be/images/addCromo.png' alt='' />");
			print("<p>Agregar coleción</p>");
			print("</button>");
			print("</form>");
			print("</div>");
		}
		
		
		
		print('<form class="numerationPage" method="POST" action="');
		print($action);
		print('?'. session_name().'='. session_id().'">');
		print('<input type="submit" name="page" value="Anterior página" />');
		print('<input type="hidden" name="previousPage" value="');
		print($page-1);
		print('" />');
		
		print('<input type="hidden" name="id" value="');
		print($id);
		print('" />');

		$init=0;
		$final=$totalPages;
		if($totalPages>15){
			if(($page+8)>$final){
				$init=$final-15;
			}else{
				$init=$page-7;
				$final=$page+8;
			}		
		}	
		
		for($j=$init; $j<$final; $j++){
			if($j==$page){
				print('<input class="actualPage"  type="submit" name="page" value="');
			}else{
				print('<input type="submit" name="page" value="');
			}
			print($j+1);
			print('" />');
		}
		print("<input type='hidden' name='type' value='");
		print($type);
		print("' />");
		print('<input type="hidden" name="nextPage" value="');
		print($page+1);
		print('" />');
		print('<input type="submit" name="page" value="Siguiente página" />');
		print('</form>');
		
	}
	
	function itemListManager($data, $type){
		print("<div class='itemList'>");
		print('<form method="POST" action="');
		if ($type == CROMO){
			print("/practicaI/10569937caa2b6913ca7f7b533c2d4be/php/Administrador/manageCromo.php");
		} else {
			print("/practicaI/10569937caa2b6913ca7f7b533c2d4be/php/Administrador/manageCollection.php");
		}
		print('?'. session_name().'='. session_id().'">');
		print('<button type="submit">');
		print("<input type='hidden' name='id' value='".$data->getId()."' />");
		print("<input type='hidden' name='type' value='".$type."' />");		
		
		print("<img src='/practicaI/10569937caa2b6913ca7f7b533c2d4be/imagesSticker/");
		if($type==CROMO){
			print(htmlentities($data->getImage()));
			print("' alt='' />");
			print("<p>".htmlentities($data->getNombre())."</p>");
			print("<p>".htmlentities("Colección: ").$data->getNameCollection()."</p>");			
			print("<p>Precio: ".$data->getPrice()."€ (Stock: ".$data->getStock().")</p>");
		}else{
			print(htmlentities($data->getImage()));
			print("' alt='' />");
			print("<p>".htmlentities($data->getCollectionName())."</p>");
			print("<p>Cromos: ".htmlentities($data->getNumberSticker())."</p>");
			print("<p>Precio: ".$data->getPrice()."€ (Stock: ".$data->getStock().")</p>");
		}
		print("</button>");
		print("</form>");
		print("</div>");
		
	}
*/
}
?>