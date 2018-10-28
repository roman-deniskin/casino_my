<?

namespace Model\Prizes;
use core\databases as db;
use Model\Casino as casino;


/*
|--------------------------------------------------------------------------
| Users prizes class | Базовый класс призов.
|--------------------------------------------------------------------------
|
| This class manages app's prizes. 
| This class can add, delete prizes and return prizes info.
|
| Этот класс обеспечивает базовый функционал работы с призами.
| Он создаёт и удаляет призы, добавляет приз пользователю, а так же, возвращает информацию о призе.
| От данного класса наследуется функционал для дочерних классов.
*/


class Prizes{


	// Возвращаем информацию о предмете по его ID.
	public static function getThingInfo($thingID){
		$thingInfo = [];
		$thing = db\database::startConnect('SELECT * FROM `things` WHERE `thing_id` = :thingID', array('thingID' => $thingID));
		foreach($thing as $row) {
        	$thingInfo = $row;
    	}
    	return $thingInfo;
	}


	// Возвращаем информацию о бонусе.
	public static function getBonuseInfo($bonuseID){
		$thingInfo = [];
		$thing = db\database::startConnect('SELECT * FROM `bonuses` WHERE `bonuse_id` = :bonuseID', array('bonuseID' => $bonuseID));
		foreach($thing as $row) {
        	$thingInfo = $row;
    	}
    	return $thingInfo;
	}


	// Возвращаем информацию о денежном призе.
	public static function getMoneyInfo($moneyID){
		$thingInfo = [];
		$thing = db\database::startConnect('SELECT * FROM `money` WHERE `money_id` = :moneyID', array('moneyID' => $moneyID));
		foreach($thing as $row) {
        	$thingInfo = $row;
    	}
    	return $thingInfo;
	}



	// Возвращаем информацию о всех предметах.
	public static function getAllThingsInfo(){
		$thingsInfo = [];
		$things = db\database::startConnect('SELECT * FROM `things`', array());
		foreach($things as $row) {
        	array_push($thingsInfo, $row);
    	}
    	return $thingsInfo;
	}



	// Возвращаем информацию о призах пользователя.
	public static function getUserPrizes($userId){
		$prizesInfo = [];
		$prizes = db\database::startConnect('SELECT * FROM `user_prizes` WHERE 	`user_id` = :userId', array('userId' => $userId));
		foreach($prizes as $row) {
			$prizesInfo = $row;
        	if($row['prize_type_id'] == 1){
        		$prizesInfo['type'] = 'thing';
        		$prizesInfo['prize_detail_info'] = self::getThingInfo($row['prize_id']);
        	}
        	if($row['prize_type_id'] == 2){
        		$prizesInfo['type'] = 'money';
        		$prizesInfo['prize_detail_info'] = self::getMoneyInfo($row['prize_id']);
        	}
        	if($row['prize_type_id'] == 3){
        		$prizesInfo['type'] = 'bonuses';
        		$prizesInfo['prize_detail_info'] = self::getBonuseInfo($row['prize_id']);
        	}
    	}
    	return $prizesInfo;
	}



	// Добавляем новый предмет.
	public static function addPrizeThing($name, $photo, $price, $chance, $description, $quantity){
		$thing = db\database::startConnect('INSERT INTO `things`(`thing_name`, `thing_photo`, `thing_price`, `thing_chance`, `thing_description`, `thing_quantity`) 
			VALUES (:thing_name,:thing_photo,:thing_price,:thing_chance,:thing_description,:thing_quantity)', 
			array('thing_name'=>$name, 'thing_photo'=>$photo, 'price'=>$price, 'thing_chance'=>$chance, 'thing_description'=>$description, 'thing_quantity'=>$quantity));
	}



	// Добавляем денежный приз.
	public static function addPrizeMoney($value){
		$casinoBalance = casino\casino::getCasinoBalance();
		$newCasinoBalance = $casinoBalance - $value;
		if($newCasinoBalance > 0){
			$money = db\database::startConnect('INSERT INTO `money`(`money_value`) VALUES (:money_value)', array('money_value'=>$value));
			if($money->lastId){
				casino\casino::updateCasinoBalance($newCasinoBalance);
			}
			return $money->lastId;	
		}
		else{
			return core\config\config::getError('casino_balance_is_over');
		}
		
	}



	// Добавляем приз бонусами.
	public static function addPrizeBonuses($value){
		$bonuses = db\database::startConnect('INSERT INTO `bonuses`(`bonuse_value`) VALUES (:bonuse_value)', array('bonuse_value'=>$value));
		return $bonuses->lastId;
	}



	// Добавляем приз бонусами или деньгами.
	public static function addUserPrize($userId, $prizeType, $prizeId, $prizeValue){
		if($prizeType == 1){
			$updateThingCount = db\database::startConnect('UPDATE `things` SET `thing_quantity`= `thing_quantity` - 1 WHERE `thing_id` = :prizeID' , array('prizeID' => $prizeId));
		}
		elseif($prizeType == 2){
			$prizeId = self::addPrizeMoney($prizeValue);
		}
		elseif($prizeType == 3){
			$prizeId = self::addPrizeBonuses($prizeValue);
		}
		$prize = db\database::startConnect('INSERT INTO `user_prizes`(`user_id`,`prize_type_id`,`prize_id`) 
		VALUES (:user_id,:prize_type_id,:prize_id)', array('user_id'=>$userId, 'prize_type_id'=>$prizeType, 'prize_id'=>$prizeId));
	}

	// Добавляем приз бонусами или деньгами.
	public static function saveUserPrize($userId){
		$savePrize = db\database::startConnect('UPDATE `user_prizes` SET `prize_status`= 1', array());
		return true;
	}



	// Удаляем приз пользователя.
	public static function deleteUserPrize($userId, $prizeId = null){
		$prizeInfo = [];
		$prizes = db\database::startConnect('SELECT * FROM `user_prizes` WHERE 	`user_id` = :userId && `prize_id` = :prizeId', array('userId' => $userId, 'prizeId' => $prizeId));
		foreach($prizes as $row) {
        	$prizeInfo = $row;
    	}
    	$userPrizeId = $prizeInfo['prize_id'] ?? '';
		if($userPrizeId != ''){
			if($prizeInfo['prize_type_id'] == 2){
				$deleteUserPrize = db\database::startConnect('DELETE FROM `user_prizes` WHERE `user_id` = :userId', array('userId' => $userId));
				$deleteBonuse = db\database::startConnect('DELETE FROM `money` WHERE `money_id` = :prizeId', array('prizeId' => $prizeId));
			}
			elseif($prizeInfo['prize_type_id'] == 3){
				$deleteUserPrize = db\database::startConnect('DELETE FROM `user_prizes` WHERE `user_id` = :userId', array('userId' => $userId));
				$deleteBonuse = db\database::startConnect('DELETE FROM `bonuses` WHERE `bonuse_id` = :prizeId', array('prizeId' => $prizeId));
			}
			else{
				$deleteUserPrize = db\database::startConnect('DELETE FROM `user_prizes` WHERE `user_id` = :userId', array('userId' => $userId));
			}
			return true;
		}
		else{
			return false;
		}
	}



	// Удаляем один предмет.
	public static function deletePrizeThing($prizeID){
		$thing = db\database::startConnect('DELETE FROM `things` WHERE `thing_id` = :thingID', array('thingID' => $prizeID));
	}



	// Удаляем все предметы.
	public static function deleteAllPrizesThings(){
		$thing = db\database::startConnect('DELETE FROM `things`', array());
	}
}
