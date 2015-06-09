<?
//RECICLABLE
const IS_LOGGED = 'isLogged';
const USER = 'user';
const LAST_TIME='last_time';

class Session{
	function abrirSession(){
		//abro sesión
		session_cache_limiter('nocache,private');
		session_name('sesionKiosko');
		session_start();
		
		if (isset($_SESSION[LAST_TIME]) && (time() - $_SESSION[LAST_TIME] > 1800)) {
    		// last request was more than 30 minutes ago
    		Session::eliminarSession();
		}
		$_SESSION[LAST_TIME] = time(); // update last activity time stamp
	}
	
	function eliminarSession(){
		//destruyo la sesión
		session_destroy();
		//destruyo las variables de sesión
		$_SESSION = array();
	}
}
?>