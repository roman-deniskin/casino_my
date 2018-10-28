<?
		
namespace core\auth;
use core\databases as db;

/*
|--------------------------------------------------------------------------
| Auth/register basic class | Базовый класс авторизации/регистрации.
|--------------------------------------------------------------------------
|
| This class registers a new user or authorises the exists user. 
| Этот класс обеспечивает базовый функционал авторизации и регистрации.
*/

class auth{


	public static function passwordValidation($password){
		if(mb_strlen($password) < 6){
			return 'short_password';
		}
		else if(mb_strlen($password) > 20){
			return 'long_password';
		}
		else{
			if(!preg_match('~^[a-z0-9_\-]*$~i',$password)){
				return 'wrong_characters';
			}
			else{
				return true;
			}
		}
	}



	public static function emailValidation($email){
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		    return true;
		}
		else{
			return 'incorrect_email';
		}
	}



	public static function randomPasswordGenerator(){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Регистр можно сгенерировать и функцией rand, но оставлю так, ибо мне lazyly.
		$newPass = '';
		$lenght = strlen($characters);
		for($i=0; $i <= 10; $i++){
			$newPass .= $characters[rand(0, $lenght)];
		}
		return $newPass;
	}



	public static function checkLogin($login){
		$checkLogin = [];
		$login = db\database::startConnect('SELECT * FROM `users` WHERE `login` = :login', array('login' => $login));
		foreach($login as $row) {
        	$checkLogin = $row;
    	}
    	return $checkLogin;
	}



	public static function checkPass($login, $pass){
		$checkPass = [];
		$pass = db\database::startConnect('SELECT * FROM `users` WHERE `login` = :login && `password` = :pass', array('login' => $login, 'pass' => $pass));
		
		foreach($pass as $row) {
        	$checkPass = $row;
        	$checkPass['auth'] = true;
    	}
    	return $checkPass;
	}



	public static function authStart($user){
		$_SESSION = $user;
	}



	public static function authClose(){
		session_unset();
	}



	public static function authCheck(){
		$userId = $_SESSION['user_id'] ?? '';
		if($userId){
			return true;
		}
		else{
			return false;
		}
	}



	public static function restorePassword($email){
		/* 
		Here must be code for password restore via mail() function. But I haven't this task and I'm lazy. I'll do it later. Yeeees, lateeer...
		Здесь должна быть отправка функцией mail() уведомления на указанную почту о смене пароля и подтверждении.
		*/
	}



	public static function confirmEmail($email){
		/* 
		Here must be code for email confirm via mail() function. But I haven't this task and I'm lazy. I'll do it later. Yeeees, lateeer...
		Здесь должна быть отправка функцией mail() уведомления на указанную почту о подтверждении почты.
		*/
	}


}