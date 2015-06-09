<?

require_once($_SERVER['DOCUMENT_ROOT'] ."/practicaI/10569937caa2b6913ca7f7b533c2d4be/php/Funciones/funcionesBaseDatos.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/practicaI/10569937caa2b6913ca7f7b533c2d4be/php/Funciones/clases.php");

class methodsSQL{
	/*
	* Registro un usuario
	*/
	function registerUser($user){
		//me conecto a la base de datos
		$conn=dataBase::connectDB();
		
		// set parameters
		$type = $user->getType();
		$pass = $user->getPassword();
		$name = $user->getNameUser();
		$points = $user->getPoints();
		
		$error="";
		if ($stmt = mysqli_prepare($conn, "INSERT INTO User (Type, Password, Name, Points) VALUES (?, ?, ?, ?)")) {
    		/* ligar parámetros para marcadores */
    		mysqli_stmt_bind_param($stmt, "sssi", $type, $pass, $name, $points);
			if(!mysqli_stmt_execute($stmt)){
				/* cerrar sentencia */
    			mysqli_stmt_close($stmt);
				if(methodsSQL::existsUser($name, $conn)==true){
					$error="El usuario ya existe. ";
				}else{
					$error="Error desconocido. No se ha añadido. ";
				}
			}
		}else{
			$error=$error."Error desconocido. No se ha añadido. ";		
		}
		
		dataBase::disconnectDB($conn);
		return $error;
	}
	
	
	
	/*
	* COmpruebo si existe el usuario dado el nombre del usuario y la conexión por donde hará la consulta
	*/
	function existsUser($name, $conn){
		$resultado = mysqli_query($conn, "SELECT * FROM User WHERE Name='".$name."'");
		$number=mysqli_num_rows($resultado)>0;
		mysqli_free_result($resultado);
		return $number;
	}
	
	
	
	/*
	* Pillo un usuario dado su nombre
	*/
	function getUser($name){
		//me conecto a la base de datos
		$conn=dataBase::connectDB();
		
		$resultado = mysqli_query($conn, "SELECT * FROM User WHERE Name='".$name."'");
		
		$user=null;
		if($row =  mysqli_fetch_assoc($resultado)) {
			$user=new User($row["User_Identifier"], $row["Type"], $row["Password"],$row["Name"], $row["Points"]);
      }
    	/* liberar el conjunto de resultados */
    	mysqli_free_result($resultado);
    	dataBase::disconnectDB($conn);
    	return $user;
	}
	
	
	
	/*
	* Obtengo $number cromos/colecciones (dado por $type) aleatorios
	* recibo un array
	*/
	function randomData($type, $number){
		//me conecto a la base de datos
		$conn=dataBase::connectDB();
		if($type==CROMO){
			$resultado = mysqli_query($conn, "SELECT s.Sticker_Id AS idSticker, s.Image AS image, s.Name AS nameSticker, s.Description AS description, s.Price AS price, s.Collection_Id AS idCollection, s.Stock AS stock, c.Name AS collectionName FROM Sticker s, Collections c WHERE s.Collection_Id=c.Collection_Id ORDER BY RAND() LIMIT ".$number);
		}else{
			$resultado = mysqli_query($conn, "SELECT Collection_Id, Image, Name, Description, State, Price, Sticker_Total_Number, Stock FROM Collections ORDER BY RAND() LIMIT ".$number);
			//$resultado = mysqli_query($conn, "SELECT c.Collection_Id, c.Image, c.Name, c.State, c.Price, c.Sticker_Total, u.Collection_State FROM Collections c, Collections_User u WHERE c.Collection_Id=u.Collection_Id AND u.User_Id=1 ORDER BY RAND() LIMIT ".$number);
		}
		
		$array=methodsSQL::recolect($resultado,$type);
		
    	/* liberar el conjunto de resultados */ 
    	mysqli_free_result($resultado);
    	dataBase::disconnectDB($conn);
    	return $array;
	}
	
	
	
	/*
	* PIllo un cromo o una colección (especificado por type) dado su id
	*/
	function getCromoOrColeccion($id, $type){
		$conn=dataBase::connectDB();
		if($type==CROMO){
			$resultado = mysqli_query($conn, "SELECT s.Sticker_Id AS idSticker, s.Image AS image, s.Name AS nameSticker, s.Description AS description, s.Price AS price, s.Collection_Id AS idCollection, s.Stock AS stock, c.Name AS collectionName FROM Sticker s, Collections c WHERE s.Collection_Id=c.Collection_Id AND Sticker_Id='".$id."'");
			//$id, $imagen, $nombre, $texto, $idCollection, $nameCollection, $price, $stock, $numberMine
			if($row =  mysqli_fetch_assoc($resultado)) {
				$data=new Cromo($row["idSticker"], $row["image"], $row["nameSticker"], $row["description"], $row["idCollection"], $row["collectionName"], $row["price"], $row["stock"], 0);
			}
		}else{
			$resultado = mysqli_query($conn, "SELECT Collection_Id, Image, Name, Description, State, Price, Sticker_Total_Number, Stock FROM Collections WHERE (Collection_Id = ".$id.")");
			$collectionStateUser=PROGRESO;
			if($row =  mysqli_fetch_assoc($resultado)) {
				$data=new Collection($row["Collection_Id"], $row["Image"], $row["Name"], $row["Description"], $row["State"], $row["Price"], $row["Sticker_Total_Number"], $row["Stock"], $collectionStateUser);
			}
		}
		/* liberar el conjunto de resultados */ 
    	mysqli_free_result($resultado);
    	dataBase::disconnectDB($conn);
		return $data;
	}
	
	
	
	/*
	* PIllo el total de cromos/colecciones que hay (dado por $type)
	*/
	function totalItems($type){
		$conn=dataBase::connectDB();
		if($type==CROMO){
			$table="Sticker";
		}else{
			$table="Collections";
		}
		$num=0;
		$resultado=mysqli_query($conn, "SELECT COUNT(*) AS total FROM ".$table);		
		if($row = mysqli_fetch_assoc($resultado)){
			$num=$row['total'];		
		}
		/* liberar el conjunto de resultados */ 
    	mysqli_free_result($resultado);
    	dataBase::disconnectDB($conn);
		return $num;
	}
	
	/*
	* PIllo el total de cromos de una colección dada (dado el id)
	*/
	function totalItemsCollection($id){
		$conn=dataBase::connectDB();
		$num=0;
		$resultado=mysqli_query($conn, "SELECT COUNT(*) AS total FROM Sticker WHERE Sticker_Id='".$id."'");		
		if($row = mysqli_fetch_assoc($resultado)){
			$num=$row['total'];		
		}
		/* liberar el conjunto de resultados */ 
    	mysqli_free_result($resultado);
    	dataBase::disconnectDB($conn);
		return $num;
	}
	
	
	/*
	* Dado un resultado de sentencia y el tipo esperado(cromo o coleccion) recojo del resultado y guardo en un array los objetos
	*/
	function recolect($resultado, $type){
		$array=array();
		$i=0;
		while($row =  mysqli_fetch_assoc($resultado)) {
			if($type==CROMO){
				//consultar si el usuario esta registrado
				$numberMine=0;//$row["numberMine"];
				$name_collection=$row["collectionName"];
				
				$array[$i]=new Cromo($row["idSticker"], $row["image"], $row["nameSticker"], $row["description"], $row["idCollection"], $name_collection, $row["price"], $row["stock"], $numberMine);
				
			}else{
				$collectionStateUser=PROGRESO;
				$array[$i]=new Collection($row["Collection_Id"], $row["Image"], $row["Name"], $row["Description"], $row["State"], $row["Price"], $row["Sticker_Total_Number"], $row["Stock"], $collectionStateUser);
			}
			$i++;
		}
		return $array;
	}
	
	
	/*
	* Dado la página actual en la que estoy y el número de cromos/colecciones(especificado por type) que hay por página
	* devuelvo el siguiente grupo de cromos/colecciones que corresponden a esa página
	*/
	function fillPage($page, $numberByPage, $type){
		$conn=dataBase::connectDB();
		$position=$page*$numberByPage;
		if($type==CROMO){
			$resultado = mysqli_query($conn, "SELECT s.Sticker_Id AS idSticker, s.Image AS image, s.Name AS nameSticker, s.Description AS description, s.Price AS price, s.Collection_Id AS idCollection, s.Stock AS stock, c.Name AS collectionName FROM Sticker s, Collections c WHERE s.Collection_Id=c.Collection_Id LIMIT ".$position.",".$numberByPage);
		}else{
			$resultado = mysqli_query($conn, "SELECT Collection_Id, Image, Name, Description, State, Price, Sticker_Total_Number, Stock FROM Collections LIMIT ".$position.",".$numberByPage);
		}
		
		$array=methodsSQL::recolect($resultado,$type);
		
		/* liberar el conjunto de resultados */ 
    	mysqli_free_result($resultado);
    	dataBase::disconnectDB($conn);
		return $array;
	}
	
	
	/*
	* Dado la página actual en la que estoy y el número de cromos que hay por página
	* devuelvo el siguiente grupo de cromos que corresponden a esa página, siempre identificados bajo un id de colección
	*/
	function fillPageCollection($idCollection, $page, $numberByPage){
		$conn=dataBase::connectDB();
		$position=$page*$numberByPage;
		$resultado = mysqli_query($conn, "SELECT s.Sticker_Id AS idSticker, s.Image AS image, s.Name AS nameSticker, s.Description AS description, s.Price AS price, s.Collection_Id AS idCollection, s.Stock AS stock, c.Name AS collectionName FROM Sticker s, Collections c WHERE s.Collection_Id=c.Collection_Id AND s.Collection_Id='".$idCollection."' LIMIT ".$position.",".$numberByPage);

		$array=methodsSQL::recolect($resultado,CROMO);
		
		/* liberar el conjunto de resultados */ 
    	mysqli_free_result($resultado);
    	dataBase::disconnectDB($conn);
		return $array;
	}
	
	function guardarCromo($cromo){
		//me conecto a la base de datos
		$conn=dataBase::connectDB();		
		
		$id = $cromo->getId();
		$imagen = $cromo->getImage();
		$nombre = $cromo->getNombre();
		$texto = $cromo->getTexto();
		$idCollection = $cromo->getIdCollection();
		$price = $cromo->getPrice();
		$stock = $cromo->getStock();
		
		if ($id == -1) {		
			$error="";
			if ($stmt = mysqli_prepare($conn, "INSERT INTO Sticker (Image, Name, Description, Price, Collection_Id, Stock) VALUES (?, ?, ?, ?, ?, ?)")) {
				/* ligar parámetros para marcadores */
				mysqli_stmt_bind_param($stmt, "sssiii", $imagen, $nombre, $texto, $price, $idCollection, $stock);
				if(!mysqli_stmt_execute($stmt)){
					$error = mysqli_stmt_error($stmt);
					/* cerrar sentencia */
					mysqli_stmt_close($stmt);
				}
			}else{
				$error=$error."Error desconocido. No se ha añadido. ";		
			}
			
			dataBase::disconnectDB($conn);
			return $error;
		} else {
			$error="";
			if ($stmt = mysqli_prepare($conn, "UPDATE `Sticker` SET  Image = ?, Name=?, Description=?, Price=?, Collection_Id=?, Stock=?  WHERE Sticker_Id = '".$id."'")) {
				/* ligar parámetros para marcadores */
				mysqli_stmt_bind_param($stmt, "sssiii", $imagen, $nombre, $texto, $price, $idCollection, $stock);
				if(!mysqli_stmt_execute($stmt)){
					$error = mysqli_stmt_error($stmt);
					/* cerrar sentencia */
					mysqli_stmt_close($stmt);
				}
			}else{
				$error=$error."Error desconocido. No se ha añadido. ";		
			}
			
			dataBase::disconnectDB($conn);
			return $error;
		}
	}
	
	function guardarCollection($collection){
		//me conecto a la base de datos
		$conn=dataBase::connectDB();
		
		//$imageFileType = pathinfo(, $PATHINFO_EXTENSION);
		
		$id = $collection->getId();
		$imagen = $collection->getImage();
		$nombre = $collection->getCollectionName();
		$texto = $collection->getTexto();
		$price = $collection->getPrice();
		$stock = $collection->getStock();
		
		if ($id == -1) {		
			$error="";
			if ($stmt = mysqli_prepare($conn, "INSERT INTO Collections (Image, Name, Description, State, Price, Sticker_Total_Number, Stock) VALUES (?, ?, ?, " . ACTIVA . ", ?, 0, ?)")) {
				/* ligar parámetros para marcadores */
				mysqli_stmt_bind_param($stmt, "sssii", $imagen, $nombre, $texto, $price, $stock);
				if(!mysqli_stmt_execute($stmt)){
					$error = mysqli_stmt_error($stmt);
					/* cerrar sentencia */
					mysqli_stmt_close($stmt);
				}
			}else{
				$error=$error."Error desconocido. No se ha añadido. ";		
			}
			
			dataBase::disconnectDB($conn);
			return $error;
		} else {
			$error="";
			if ($stmt = mysqli_prepare($conn, "UPDATE Collections SET Image = ?, Name = ?, Description = ?, Price = ?, Stock = ? WHERE (Collection_Id = ".$id.")")) {
				/* ligar parámetros para marcadores */
				mysqli_stmt_bind_param($stmt, "sssii", $imagen, $nombre, $texto, $price, $stock);
				if(!mysqli_stmt_execute($stmt)){
					$error = mysqli_stmt_error($stmt);
					/* cerrar sentencia */
					mysqli_stmt_close($stmt);
				}
			}else{
				$error=$error."Error desconocido. No se ha añadido. ";		
			}
			
			dataBase::disconnectDB($conn);
			return $error;
		}
	}
}
?>