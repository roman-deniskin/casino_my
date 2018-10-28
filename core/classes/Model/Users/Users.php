<?

namespace Model\Users;
use core\databases as db;

/*
|--------------------------------------------------------------------------
| Users basic class | Базовый класс пользователя.
|--------------------------------------------------------------------------
|
| This class manages app's users. 
| This class can add, delete users and return user info.
|
| Этот класс обеспечивает базовый функционал работы с пользователем.
| Он создаёт и удаляет пользователя, а так же, возвращает информацию о нём.
| От данного класса наследуется функционал для дочерних классов.
*/


class Users{

	// Возвращаем инфу о пользователе по его ID.
	public static function getUserInfo($userID){
		$userInfo = [];
		$user = db\database::startConnect('SELECT * FROM `users` WHERE `user_id` = :userID', array('userID' => $userID));
		foreach($user as $row) {
        	$userInfo = $row;
    	}
    	return $userInfo;
	}


	// Возвращаем инфу о всех пользователях.
	public static function getAllUsersInfo(){
		$usersInfo = [];
		$users = db\database::startConnect('SELECT * FROM `users`', array());
		foreach($users as $row) {
        	array_push($usersInfo, $row);
    	}
    	return $usersInfo;
	}


	// Добавляем нового пользователя.
	public static function addUser($name, $login, $password){
		$user = db\database::startConnect('INSERT INTO `users`(`user_name`, `login`, `password`) 
			VALUES (:user_name,:login,:password)', 
			array('user_name'=>$name, 'login'=>$login, 'password'=>$password));
		return $user;
	}


	// Добавляем приз пользователю.
	public static function addPrizeForUser($userId, $prizeTypeId, $prizeId){
		$thing = db\database::startConnect('INSERT INTO `user_prizes`(`user_id`, `prize_type_id`, `prize_id`) 
			VALUES (:user_id,:prize_type_id,:prize_id)', 
			array('user_id'=>$userId, 'prize_type_id'=>$prizeTypeId, 'prize_id'=>$prizeId));
	}


	// Удаляем пользователя.
	public static function deleteUser($userID){
		$user = db\database::startConnect('DELETE FROM `users` WHERE `user_id` = :userID', array('userID' => $userID));
	}


	// Удаляем всех пользователей.
	public static function deleteAllUsers(){
		$user = db\database::startConnect('DELETE FROM `users`', array());
	}
}
