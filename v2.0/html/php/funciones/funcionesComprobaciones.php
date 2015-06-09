<?
//Se recicla enterito
class comprobaciones{

	//compruebo los errores mysql y escribo el mensaje correspondiente
	function errorMySql($error,$exito){
		if ($error==0){
			$_SESSION['mensaje']="<h2>".$exito."</h2>";
		}else{
			$_SESSION['mensaje']="<h2>".comprobaciones::numErrorMySql($error)."<br>No se ha realizado la operaci�n.</h2>";
		}
	}
	
	//compruebo que error ha dado y muestro un mensaje orientativo del tipo de error
	function numErrorMySql($error){
		switch ($error){
			case -1:
				$mensaje="Error grave, no existe la base de datos";
				break;
			case 1020:
				$mensaje="Aviso: El registro se ha modificado desde la ultima lectura";
				break;
			case 1040:
				$mensaje="Error: demasiadas conexiones a la base de datos, intente mas tarde";
				break;
			case 1062:
			case 1022:
			case 1169:
				$mensaje="Error: Clave duplicada";
				break;
			case 1118:
				$mensaje="Error: Cadena demasiado larga";
				break;
			case 1129:
				$mensaje="Error: Servidor bloqueado, avise al administrador";
				break;
			case 1192:
				$mensaje="Error: tablas bloqueadas u operaci�n activa, intente m�s tarde";
				break;
			case 1451:
			case 1452:
				$mensaje="Error por referencias en tabla externa";
				break;
			case 2003:
				$mensaje="Error conectando a la base de datos";
				break;
			case 2013:
				$mensaje="Error, caida del servidor";
				break;
			default:
				$mensaje="Error desconocido: ".$error;
				break;
		}
		return $mensaje;
	}

	//comprueba que se han escrito n�meros de la longuitud especificada
	function numeros($campo,$min,$max){
		//solo comprueba que sean n�meros
		if($min==0 AND $max==0){
			return preg_match('/^\d{0,}$/',$campo);
		}else{
			//comprueba que sean n�meros con un m�nimo
			if($min!=0 AND $max==0){
				return preg_match('/^\d{'.$min.',}$/',$campo);
			//comprueba que sean n�meros con un m�nimo y un m�ximo
			}else{
				return preg_match('/^\d{'.$min.','.$max.'}$/',$campo);
			}
		} 
	}
	
	
	
	//comprueba que se haya introducido algo, puede aparecer n�meros, guiones bajos, espacios y tiene que aparecer una letra o m�s. el conjunto numeros y letras tiene que estar al menos una vez o puede aparecer m�s
	function campoRellenado($campo){
		return preg_match('/^[a-zA-Z\d_\s]+/i',$campo);
	}
	
	
	//comprueba que se ha rellenado el campo y admite espacios
	function nombreRellenado($campo){
		return preg_match('/^([a-zA-Z\s������])+$/i',$campo);
	}
	
	//compruebo el email
	function email($valor){
		return preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$valor);

		return true;
	}
}
?>