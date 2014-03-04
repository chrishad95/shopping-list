<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once './idiorm.php';
require_once './database.php';

ORM::configure("mysql:host=" . $db_host . ";dbname=" . $db_name . ";");
ORM::configure('username', $db_username);
ORM::configure('password', $db_password);

if ( $_SERVER['REQUEST_METHOD']  == "PUT" ) {

	$requestData = json_decode(file_get_contents('php://input'));

	$list = ORM::for_table('shopping_lists')->create();
	$list->name = $requestData->data->name;
	$list->save();
	$lists = ORM::for_table('shopping_lists')->find_array();
}else{  

	if(isset($_GET['id']) && !empty($_GET['id']) ) {
		$lists = ORM::for_table('shopping_lists')->where('id', $_GET['id'])->find_array();
	} else {
		$lists = ORM::for_table('shopping_lists')->find_array();
	}
}

echo json_encode($lists);
?>

