<?
use Model\Prizes as Prizes;
use Model\Casino as Casino;
/*
|--------------------------------------------------------------------------
| Prizes component | Компонент розыгрыша призов.
|--------------------------------------------------------------------------
|
| This component shows, deletes and adds prizes for user.
| Этот компонент добавляет, удаляет и показывает призы пользователя.
*/
// Если авторизован
if(core\auth\auth::authCheck()){
	$userId = $_SESSION['user_id'] ?? '';
	$action = $_POST['action'] ?? '';
	$items = Prizes\Prizes::getAllThingsInfo();
	foreach($items as $key => $value){
		$items[$key]['type'] = 1;
		$items[$key]['prize_id'] = $items[$key]['thing_id'];
		$items[$key]['value'] = '';
	}
	$arResult['items'] = $items;
	$arResult['casino_balance'] = Casino\Casino::getCasinoBalance();
	$userPrizes = Prizes\Prizes::getUserPrizes($userId);
	$userPrizesId = $userPrizes['prize_id'] ?? '';


	//Добавляем приз пользователя
	if($action == 'get_prize' && $userPrizesId == ''){
		$prizes = [];
		$bonuses = [];
		$money = [];
		$maxMoneyForPrize = Casino\Casino::getCasinoBalance()*0.6;
		for($i = 0; $i < count($items); $i++){
			if($maxMoneyForPrize > 1000){
				$money[] = ['value' => rand(1000, $maxMoneyForPrize), 'type' => '2'];	
			}
			$bonuses[] = [ 'value' => rand(1000, 100000), 'type' => '3'];
		}
		$totalArray = array_merge($items, $bonuses);
		if($maxMoneyForPrize > 1000){
			$totalArray = array_merge($totalArray, $money);
		}
		$getPrize = $totalArray[ rand(0, count($totalArray)-1)];
		$newPrizeId = $getPrize['prize_id'] ?? '';
		Prizes\Prizes::addUserPrize($userId, $getPrize['type'], $newPrizeId, $getPrize['value']);
		$arResult['items'] = $items;
		$userPrizes2 = Prizes\Prizes::getUserPrizes($userId);
		$arResult['user_prizes'] = $userPrizes2;
		$_POST['action'] = '';
		$action = '';
	}
	// Удаляем приз пользователя.
	elseif($action == 'delete_prize' && $userPrizesId != ''){
		$deletePrize = Prizes\Prizes::deleteUserPrize($userId, $userPrizesId);
	}
	// Сохраняем приз пользователя.
	elseif($action == 'save_prize' && $userPrizesId != ''){
		$savePrize = Prizes\Prizes::saveUserPrize($userId);
	}
	// Возвращаем информацию о призе пользователя.
	else{
		$userPrizes = Prizes\Prizes::getUserPrizes($userId);
		$arResult['user_prizes'] = $userPrizes;
	}
}
// Требуем авторизацию, если не авторизован.
else{
	$arResult['error'] = core\config\config::getError('need_auth');
}
?>