<?php

const USER=1;
const CATEGORIA=1;
const PRODUCTO=1;
/*3 para clientes, 2 para dependientes y 1 para administradores
los administradores son aniadidos por el soporte informatico */
const CLIENT_USER=3;
const EMPLOYEE_USER=2;
const ADMIN_USER=1;
const ACTIVA=1;
const AGOTADA=2;
const SIN_EMPEZAR=1;
const PROGRESO=2;
const TERMINADA=3;

//clase de cada elemento
class productos{
	var $id;
	var $nombre;
	var $stock;
	var $price;
	var $marca;
	var $tamanio;
	var $id_categoria;
	
	
	function productos($id, $nombre, $stock, $price, $marca, $tamanio, $id_categoria){
		$this->id=$id;
		$this->nombre=$nombre;	
		$this->stock=$stock;
		$this->price=$price;
		$this->marca=$marca;
		$this->tamanio=$tamanio;
		$this->id_categoria=$id_categoria;
	}
	
	function getId(){
		return	$this->id;}
	function getNombre(){
		return $this->nombre;}
	function getStock(){
		return $this->stock;}
	function getPrice(){
		return $this->price;}
	function getMarca(){
		return $this->marca;}
	function getTamnio(){
		return $this->tamanio;}
	function getId_Categoria(){
		return $this->id_categoria;}
	
}


class categorias{
	var $id_categoria;
	var $nombre;
	var $id_producto;
	
	function getCategorias($id_categoria, $nombre, $id_producto){
		$this->id=$id_categoria;
		$this->nombre=$nombre;
		$this->id_producto=$id_producto;
	}
	
	function getNombre(){
		return $this->nombre;
	}
	
	function getId_producto(){
		return $this->id_producto;
	}
}

class usuarios{
	var $id_usuario;
	var $usuario;
	var $nombre;
	var $apellidos;
	var $dni;
	var $tipo;
	var $contrasenia;
	
	function usuarios($id_usuario, $usuario, $nombre, $apellidos, $dni, $tipo, $contrasenia){
		$this->id_usuario=$id_usuario;
		$this->usuario=$usuario;
		$this->nombre=$nombre;
		$this->apellidos=$apellidos;
		$this->dni=$dni;
		$this->tipo=$tipo;
		$this->contrasenia=$contrasenia;
	}
	
	function setId_Usuario($newUser){ /*no esta bien*/
		return $this->id_usuario;
	}
	
	function getId_User(){
		return $this->id_usuario;	
	}
	
	function getUsuario(){
		return $this->usuario;
	}
	
	function getNombre(){
		return $this->nombre;
	}
	
	function getApellidos(){
		return $this->apellidos;
	}
	
	function getDni(){
		return $this->dni;
	}
	
	function getTipo(){
		return $this->tipo;
	}
	
	function getContrasenia(){
		return $this->contrasenia;
	}	
}
?>
