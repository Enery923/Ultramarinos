<?
/*La necesitamos ??????????????????? */




//Se guardan las sentencias para crear las tablas en un array
//Las tablas de la base de datos 'Kiosko' son: User, Collections, Collections_User, Memeber, Sticker, Sticker_List
						
$tables['User']="CREATE TABLE IF NOT EXISTS User (
							`User_Identifier` int(5) AUTO_INCREMENT,
							`Type` varchar(15)  NOT NULL,
							`Password` varchar(50)  NOT NULL,
							`Name` varchar(20)  NOT NULL,
							`Points` int(11) NOT NULL,
 
  							PRIMARY KEY (User_Identifier),
  							UNIQUE userName (Name)
						)";
						
$tables['Collections']="CREATE TABLE IF NOT EXISTS Collections (
							`Collection_Id` int(5) AUTO_INCREMENT,
							`Image` varchar(50) NOT NULL,
							`Name` varchar(40) NOT NULL,
							`Description` varchar(250) NOT NULL,
							`State` tinyint(1) NOT NULL DEFAULT '0',
							`Price` int(5) NOT NULL,
							`Sticker_Total_Number` int(11) NOT NULL DEFAULT '0',
							`Stock` int(5) NOT NULL DEFAULT '0',
							
							PRIMARY KEY (Collection_Id)		
						)";
						
$tables['Collections_User']="CREATE TABLE IF NOT EXISTS Collections_User (
							`User_Id` int(5) NOT NULL,
							`Collection_Id` int(5) NOT NULL,
							`Collection_State` varchar(20) NOT NULL,
							
							PRIMARY KEY (Collection_Id, User_Id),
							FOREIGN KEY(User_Id) REFERENCES User(User_Identifier),
							FOREIGN KEY(Collection_Id) REFERENCES Collections(Collection_Id)
							
						)";
						
$tables['Sticker']="CREATE TABLE IF NOT EXISTS Sticker (
							`Sticker_Id` int(5) AUTO_INCREMENT,
							`Image` varchar(50) NOT NULL,
							`Name` varchar(50) NOT NULL,
							`Description` varchar(250) NOT NULL,
							`Price` int(5) NOT NULL,
							`Collection_Id` int(5) NOT NULL,
							`Stock` int(5) NOT NULL DEFAULT '0',
						
							PRIMARY KEY (Sticker_Id),
							INDEX Stick_Collect (Collection_Id), 
							UNIQUE stickerName (Image),
							FOREIGN KEY(Collection_Id) REFERENCES Collections(Collection_Id)
							
						)";
						
$tables['Sticker_List']="CREATE TABLE IF NOT EXISTS Sticker_List (
							`User_Id` int(5) NOT NULL,
							`Sticker_Id` int(5) NOT NULL,
							`Collection_Id` int(5) NOT NULL,
							`Sticker_Number` int(11) NOT NULL,
 
  							PRIMARY KEY (User_Id, Sticker_Id, Collection_Id),
  							INDEX stiList (Collection_Id),
							FOREIGN KEY(User_Id) REFERENCES User(User_Identifier),
							FOREIGN KEY(Sticker_Id) REFERENCES Sticker(Sticker_Id),
							FOREIGN KEY (Collection_Id) REFERENCES Collections(Collection_Id)		
						)";
						
$sentencesTables=array(
'INSERT INTO User VALUES (DEFAULT,"normal","16129ba81faecef572991a9f838f712f","javier",10);',
'INSERT INTO User VALUES (DEFAULT,"normal","c25d2b21149321faf64e7302ccdc36f3","irene",10);',
'INSERT INTO Collections VALUES (DEFAULT,"LenguajesProgramacion/C++.png", "Lenguajes Programacion","Una descripción",0,5,10,10);',
'INSERT INTO Collections VALUES (DEFAULT,"LenguajesProgramacion/C++.png", "Una coleccion","Una descripción",0,7,6,10);',
'INSERT INTO Collections VALUES (DEFAULT,"LenguajesProgramacion/C++.png", "Otra coleccion","Una descripción","1","3","2",10);',
'INSERT INTO Sticker VALUES (DEFAULT,"LenguajesProgramacion/C++.png","Un nombre","Una descripción","1","1","10");',
'INSERT INTO Sticker VALUES (DEFAULT,"LenguajesProgramacion/perl.png","Un nombre","Una descripción","1","1","10");',
'INSERT INTO Sticker VALUES (DEFAULT,"LenguajesProgramacion/oracle.png","Un nombre","Una descripción","2","1","10");',
'INSERT INTO Sticker VALUES (DEFAULT,"LenguajesProgramacion/java.png","Un nombre","Una descripción","1","1","10");',
'INSERT INTO Sticker VALUES (DEFAULT,"LenguajesProgramacion/pascal.png","Un nombre","Una descripción","1","2","10");',
'INSERT INTO Sticker VALUES (DEFAULT,"LenguajesProgramacion/lisp.png","Un nombre","Una descripción","1","2","10");',
'INSERT INTO Sticker VALUES (DEFAULT,"LenguajesProgramacion/mysql.png","Un nombre","Una descripción","1","2","10");',
'INSERT INTO Sticker VALUES (DEFAULT,"LenguajesProgramacion/fortran.png","Un nombre","Una descripción","1","3","10");',
'INSERT INTO Sticker VALUES (DEFAULT,"LenguajesProgramacion/delphi.png","Un nombre","Una descripción","1","3","10");',
'INSERT INTO Sticker VALUES (DEFAULT,"LenguajesProgramacion/CSS3.png","Un nombre","Una descripción","1","3","10");',
'INSERT INTO Sticker_List VALUES ("1","3","1","2");',
'INSERT INTO Sticker_List VALUES ("1","2","1","2");',
'INSERT INTO Sticker_List VALUES ("1","4","1","2");',
'INSERT INTO Sticker_List VALUES ("1","5","2","1");',
'INSERT INTO Sticker_List VALUES ("1","6","2","1");',
'INSERT INTO Sticker_List VALUES ("2","6","2","1");',
'INSERT INTO Sticker_List VALUES ("2","5","2","1");',
'INSERT INTO Collections_User(User_Id, Collection_Id, Collection_State) VALUES (1,3,"SEMICOMPLETO")',
'INSERT INTO Collections_User(User_Id, Collection_Id, Collection_State) VALUES (1,2,"COMPLETO")',
'INSERT INTO Collections_User(User_Id, Collection_Id, Collection_State) VALUES (1,1,"NO INICIADO")',
'INSERT INTO Collections_User(User_Id, Collection_Id, Collection_State) VALUES (2,1,"NO INICIADO")',
'INSERT INTO Collections_User(User_Id, Collection_Id, Collection_State) VALUES (2,2,"COMPLETO")',
'INSERT INTO Collections_User(User_Id, Collection_Id, Collection_State) VALUES (2,3,"COMPLETO")'
);
				
//importo las funciones, MODIFICARLO CON LA RUTA EXACTA
require_once($_SERVER['DOCUMENT_ROOT'] ."/practicaI/10569937caa2b6913ca7f7b533c2d4be/php/Funciones/funcionesBaseDatos.php");

//Se establece el nombre de la base de datos
$base="Kiosko";
//Conexion a la base de datos
$connection=dataBase::connectDB();

//Se borra la base de datos
mysqli_query ($connection, "DROP DATABASE " . $base);
//Se comprueba si existe la base de datos y se crea en caso contrario
if (dataBase::checkBase($base,$connection)){
	//existe la base de datos
	print("Existe la base de datos");
}else{
	$sql = "CREATE DATABASE ".$base;
	if (mysqli_query($connection, $sql) === TRUE) {
	    echo "Database created successfully";
	} else {
	    echo "Error creating database: " . $conn->error;
	}
}
//Se selecciona la base de datos
mysqli_select_db ($connection, $base);
//Se crean las tablas si no existen (create table if not exists)
foreach ($tables as $tableName=>$sentence){
	if(mysqli_query($connection, $sentence)){
		print ("Se ha creado la tabla " . $tableName . " en la base de datos<br>");
	}else{
    	print ("Se ha producido un error al crear la tabla " . $tableName . "<br>");
		//Se muestrar mensajes de error
		print(mysqli_errno($connection) . "<br>");
		print(mysqli_error($connection) . "<br>");
	}
}
mysqli_query("COMMIT",$connection);

//Se crean las tablas si no existen (create table if not exists)
foreach ($sentencesTables as $tableName=>$sentence){
	if(mysqli_query($connection, $sentence)){
		print ("Se ha creado el registro en la base de datos<br>");
	}else{
    	print ("Se ha producido un error al insertar registro<br>");
		//Se muestrar mensajes de error
		print(mysqli_errno($connection) . "<br>");
		print(mysqli_error($connection) . "<br>");
	}
}

//Se cierra la base de datos
dataBase::disconnectDB($connection);
?>
