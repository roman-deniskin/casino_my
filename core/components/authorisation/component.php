<?
use core\auth as auth;
use Model\Users as Users;
$type = $_POST['type'] ?? '';
$login = $_POST['login'] ?? '';
$pass = $_POST['pass'] ?? '';
$pass1 = $_POST['pass1'] ?? '';
$pass2 = $_POST['pass2'] ?? '';
$name = $_POST['name'] ?? '';

if($type == 'auth' && $login != '' && $pass != ''){
	if(auth\auth::emailValidation($login)){
		if(auth\auth::passwordValidation($pass)){
			$userId = auth\auth::checkLogin($login);
			if($userId != ''){
				$userAuth = auth\auth::checkPass($login, $pass);
				$userId = $userAuth['user_id'] ?? '';
				if($userId != ''){
					$authorisation = auth\auth::authStart($userAuth);
					$arResult = $userAuth;
					$arResult['type'] = 'auth';
				}
			}
		}
	}
}
else if($type == 'reg' && $name != '' && $login != '' && $pass1 != '' && $pass2 != '' && $pass1== $pass2){
	if(auth\auth::emailValidation($login)){
		if(auth\auth::passwordValidation($pass1)){
			$arResult['type'] = 'reg';
			$checkLogin = auth\auth::checkLogin($login);
			$checkLogin = $checkLogin['login'] ?? '';
			if($checkLogin != ''){
				return core\config\config::getError('user_already_exists');
			}
			else{
				$userCreate = Users\Users::addUser($name, $login, $pass1);
				if($userCreate->lastId){
					$userInfo = Users\Users::getUserInfo($userCreate->lastId);
					$startAuth = auth\auth::authStart($userInfo);
					$arResult = $startAuth;
				}
			}
		}
	}
}
else{
	return false;
}
?>