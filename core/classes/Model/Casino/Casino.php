<?

namespace Model\Casino;
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


class Casino{

	// Возвращаем инфу о казино.
	public static function getCasinoInfo(){
		$casinoInfo = [];
		$casino = db\database::startConnect('SELECT * FROM `casino`', array());
		foreach($casino as $row) {
        	$casinoInfo = $row;
    	}
    	return $casinoInfo;
	}
	public static function getCasinoBalance(){
		return self::getCasinoInfo()['casino_balance'] ?? '';
	}
	public static function updateCasinoBalance($balance){
		$newBalance = db\database::startConnect('UPDATE `casino` SET `casino_balance`= :balance', array('balance'=>$balance));
		return self::getCasinoInfo()['casino_balance'];
	}
}
