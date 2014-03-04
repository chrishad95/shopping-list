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
	error_log("Got a post for items", 0);
	error_log('requestData->data: ' . json_encode($requestData->data), 0);


	$list_count = ORM::for_table('shopping_lists')->where('id' , $requestData->data->list_id)->count();
	if ($list_count > 0) {
		$item = ORM::for_table('shopping_items')->create();
		$item->name = $requestData->data->name;
		$item->list_id = $requestData->data->list_id;
		$item->save();
		$items = ORM::for_table('shopping_items')->where('list_id', $requestData->data->list_id)->find_array();
	}
}else{  
	error_log("Got a GET request for items", 0);
	if(isset($_GET['list_id']) && !empty($_GET['list_id']) ) {
		$items = ORM::for_table('shopping_items')->where('list_id', $_GET['list_id'])->find_array();
	} else {
		$items = ORM::for_table('shopping_items')->find_array(); }
}

echo json_encode($items);

