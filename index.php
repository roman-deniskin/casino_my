<? require_once($_SERVER['DOCUMENT_ROOT'].'/core/prolog.php');

$routesList = [
'/index' => 'main.php',
'/index.php' => 'main.php',
'/' => 'main.php',
'' => 'main.php',
'/profile' => 'profile.php',
'/profile/' => 'profile.php',
'/profile.php' => 'profile.php',
'/cabinet' => 'cabinet.php',
'/cabinet.php' => 'cabinet.php',
'/cabinet/' => 'cabinet.php',
];

core\route\route::startRoutes($_SERVER['REQUEST_URI'], $routesList, $_SERVER);

?>
