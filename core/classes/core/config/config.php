<?
namespace core\config;

/*
|--------------------------------------------------------------------------
| Config class.
|--------------------------------------------------------------------------
|
| This class is for fast access for DB configs and error's descriptions.
| Этот класс предназначен для быстрого доступа к конфигам базы данных и описаниям ошибок.
*/

class config{

	// Возвращаем все данные подключения к БД.
	public static function getAllDbInfo(){
	    include ($_SERVER['DOCUMENT_ROOT'].'/config/db.php');
	    return $db;
	}


	// Возвращаем хост базы данных.
	public static function getDbHost(){
	    return self::getAllDbInfo()['host'];
	}


	// Возвращаем логин пользователя базы данных.
	public static function getDbUsername(){
	    return self::getAllDbInfo()['username'];
	}


	// Возвращаем название базы данных.
	public static function getDbName(){
	    return self::getAllDbInfo()['dbname'];
	}


	// Возвращаем пароль пользователя базы данных.
	public static function getDbPass(){
	    return self::getAllDbInfo()['password'];
	}


	// Возвращаем описание ошибки.
	public static function getError($code){
	    include ($_SERVER['DOCUMENT_ROOT'].'/config/errors.php');
	    return $errors[$code] ?? self::getError('error_not_found');
	}
}
?>