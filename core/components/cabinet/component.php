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
// Если авторизован, показываем приз.
if(core\auth\auth::authCheck()){
	$userId = $_SESSION['user_id'] ?? '';
	$userPrizes = Prizes\Prizes::getUserPrizes($userId);
	$arResult['user_prizes'] = $userPrizes;
}
// Если не авторизован, требуем авторизацию.
else{
	$arResult['error'] = core\config\config::getError('need_auth');
}
?>