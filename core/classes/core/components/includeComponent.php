<?
namespace core\components;

/*
|--------------------------------------------------------------------------
| Components class.
|--------------------------------------------------------------------------
|
| This class is for a components work. The component - is a controller, which works with model, handles data and transmites them in a template. 
| Класс предназначен для работы компонентов. Компонент - это контроллер, работающий с моделью, обрабатывающий данные и передающий результат в шаблон.
*/


class includeComponent{

	/** Подключаем код компонента, вставив массив с указанием пространства имён и папкой компонента. **/
	protected static function includeComponentCode($componentName){
		$arResult = array();
   		include($_SERVER['DOCUMENT_ROOT'].'/core/components/'.$componentName.'/component.php');
   		return $arResult;
	}

	/** Подключаем код шаблона. **/
	protected static function includeComponentTemplate($componentName, $componentTemplate, $arResult){
		if(file_exists($_SERVER['DOCUMENT_ROOT'].'/core/components/'.$componentName.'/templates/'.$componentTemplate.'/template.php')){
   			include($_SERVER['DOCUMENT_ROOT'].'/core/components/'.$componentName.'/templates/'.$componentTemplate.'/template.php');
		}
		else{
			if(file_exists($_SERVER['DOCUMENT_ROOT'].'/core/components/'.$componentName.'/templates/default/template.php')){
	   			include($_SERVER['DOCUMENT_ROOT'].'/core/components/'.$componentName.'/templates/default/template.php');
			}
			else{
				echo 'Component template "'.$componentTemplate.'" not found.';
			}
		}
	}

	/** Подключаем сам компонент, используя предыдущие закрытые функции. **/
	public static function add($componentName, array $componentParams, $componentTemplate){
		$arResult = self::includeComponentCode($componentName);
		self::includeComponentTemplate($componentName, $componentTemplate, $arResult);
	}

}


?>