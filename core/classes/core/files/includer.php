<?
namespace core\files;
use core\templates;



/*
|--------------------------------------------------------------------------
| Files includer class.
|--------------------------------------------------------------------------
|
| This class is for include JS, CSS and IMG in code.
| Этот класс предназначен для подключения JS, CSS и IMG файлов в теле страницы.
*/


class includer{

	/** Проверяем URL на наличие слеша в начале, если его нет - добавляем. **/
	private static function checkUrlSlashInBegin(string $url){
		if (substr($url, 0, 1) == '/'){
			return $url;
		}
		else {
			return '/'.$url;
		}
	}

	/** Подключаем JS файл. **/
	public static function getJS(string $urlJS, string $syncAttr = ''){
		$urlJS = self::checkUrlSlashInBegin($urlJS);
		$fullJSurl = $_SERVER['DOCUMENT_ROOT'].'/local/templates/'.templates\templates::getCurrentTemplate().$urlJS;
		$shortJSurl = '/local/templates/'.templates\templates::getCurrentTemplate().$urlJS;
		if (file_exists($fullJSurl)){
			return '<script '.$syncAttr.' type="text/javascript" src="'.$shortJSurl.'"></script>';
		}
		else {
			return 'JS file not exist on "'.$shortJSurl.'" addr';
		}
		
	}

	/** Подключаем CSS файл. **/
	public static function getCSS(string $urlCSS, string $syncAttr = ''){
		$urlCSS = self::checkUrlSlashInBegin($urlCSS);
		$fullCSSurl = $_SERVER['DOCUMENT_ROOT'].'/local/templates/'.templates\templates::getCurrentTemplate().$urlCSS;
		$shortCSSurl = '/local/templates/'.templates\templates::getCurrentTemplate().$urlCSS;
		if (file_exists($fullCSSurl)){
			return '<link href="'.$shortCSSurl.'" type="text/css" rel="stylesheet">';
		}
		else {
			return 'CSS file not exist on "'.$shortCSSurl.'" addr';
		}
	}

	/** Подключаем IMG файл. **/
	public static function getIMG(string $urlIMG){
		$urlIMG = self::checkUrlSlashInBegin($urlIMG);
		$fullIMGurl = $_SERVER['DOCUMENT_ROOT'].'/local/templates/'.templates\templates::getCurrentTemplate().$urlIMG;
		$shortIMGurl = '/local/templates/'.templates\templates::getCurrentTemplate().$urlIMG;
		if (file_exists($fullIMGurl)){
			return $shortIMGurl;
		}
		else {
			return 'IMG file not exist on "'.$shortIMGurl.'" addr';
		}
	}
}


?>