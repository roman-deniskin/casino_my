<?
namespace core\databases;
use PDO;
use core\config as config;
/*
|--------------------------------------------------------------------------
| Database class.
|--------------------------------------------------------------------------
|
| This class is for connect to database, execute queries and return results.
| Этот класс предназначен для подключения к базе данных, выполнения запросов и возврата результата.
*/

class database{
	public static function startConnect($query, $queryParams){
	    $options = [
	        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        PDO::ATTR_EMULATE_PREPARES   => false,
	        PDO::ATTR_PERSISTENT => false,
	    ];
		$connect = new PDO('mysql:host='.config\config::getDbHost().';dbname='.config\config::getDbName().'', config\config::getDbUsername(), config\config::getDbPass(), $options);
		$query_result = $connect->prepare($query);
		$query_result->execute($queryParams);
		$query_result->lastId = $connect->lastInsertId(); // Добавляем ID последней записи как свойство объекта PDO, который можно использовать для цепочки запросов.
		return $query_result;
	}
	public static function closeConnect($connect, $query){
		// Здесь должен быть код закрытия сеанса с базой данных.
	}
}
?>