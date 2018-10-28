<?
namespace core\route;

/*
|--------------------------------------------------------------------------
| Route class.
|--------------------------------------------------------------------------
|
| This class is for routes in the app.
| Этот класс предназначен для создания ЧПУ.
*/


class route{

	// Метод инициализирует маршруты приложения.
	public static function startRoutes( string $currentRoute = 'index', array $routesList){
		if(!empty($routesList[$currentRoute])){
			if(file_exists($_SERVER['DOCUMENT_ROOT'].'/apps/'.$routesList[$currentRoute])){
				require_once($_SERVER['DOCUMENT_ROOT'].'/apps/'.$routesList[$currentRoute]);
			}
			else{
				echo core\config\config::getError('route_not_found');
			}	
		}
		else{
			require_once($_SERVER['DOCUMENT_ROOT'].'/apps/main.php');
		}
	}
}