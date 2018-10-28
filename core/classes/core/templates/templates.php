<?
namespace core\templates;

/*
|--------------------------------------------------------------------------
| Templates class.
|--------------------------------------------------------------------------
|
| This class is for include any templates in app sections. 
| Этот класс предназначен для подключения шаблонов в различных разделах сайта.
*/


class templates{

	/** Получаем список шаблонов сайта в виде массива **/
	public static function getTemplates(){
		require($_SERVER['DOCUMENT_ROOT'].'/local/templates/templates.php');
		return $templatesList;
	}

	/** Получаем текущий шаблон сайта **/
	public static function getCurrentTemplate(){
		require($_SERVER['DOCUMENT_ROOT'].'/local/templates/templates.php');
		$urlArray = explode("/", $_SERVER['REQUEST_URI']);
		$templateName = $urlArray[1];
		if(!empty($templatesList[$templateName])){
			if(file_exists($_SERVER['DOCUMENT_ROOT'].'/local/templates/'.$templatesList[$templateName])){
				return $templatesList[$templateName];
			}
			else{
				return 'Такого шаблона не существует.';
			}
		}
		else{
			return 'default';
		}
	}

	/** Получаем url конкретного шаблона сайта по его имени **/
	public static function getTemplatePath(string $name){
		return $_SERVER['DOCUMENT_ROOT'].'/local/templates/'.$name.'/';
	}

	/** Получаем url текущего шаблона сайта**/
	public static function getCurTemplatePath(){
		return $_SERVER['DOCUMENT_ROOT'].'/local/templates/'. self::getCurrentTemplate().'/';
	}

	/** Устанавливаем хедер страницы **/
	public static function getHeader(){
		require_once($_SERVER['DOCUMENT_ROOT'].'/local/templates/'. self::getCurrentTemplate().'/header.php');
	}


	/** Устанавливаем футер страницы **/
	public static function getFooter(){
		require_once($_SERVER['DOCUMENT_ROOT'].'/local/templates/'. self::getCurrentTemplate().'/footer.php');
	}

}