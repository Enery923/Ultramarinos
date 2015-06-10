<?
require_once($_SERVER['DOCUMENT_ROOT'] ."/v2.0/html/php/session.php");
Session::abrirSession();
require_once($_SERVER['DOCUMENT_ROOT'] ."/v2.0/html/php/Funciones/funcionesHTML.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/v2.0/html/php/Funciones/metodosMySQL.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."v2.0/html/php/Funciones/clases.php");
//header("Location: /v2.0/html/php/index.php?". session_name()."=". session_id());
print(codigoHtml::inicioHtml());
?>
<!--Introducimos la parte html-->
	<div id="body">
	</div>
<?
print(codigoHtml::footer());
?>