<?
use core\auth as auth;
$action = $_POST['action'] ?? '';
if($action == 'logout'){
	auth\auth::authClose();
	$_POST['action'] = '';
	$action = '';
}
?>