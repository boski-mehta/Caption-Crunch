<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__.'/conf.php'; 
require __DIR__.'/connection.php'; 
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$actionTemp = explode('::', $_REQUEST['action']);
$action = $actionTemp[0];
$store = $actionTemp[1];
$access_token = shopify\access_token($store, SHOPIFY_APP_API_KEY, SHOPIFY_APP_SHARED_SECRET, 'b4bafa413e4d97bf248310b1bd3f6071');
echo $access_token = $access_token;
$storeData = json_decode(file_get_contents("https://{$store}/admin/shop.json?access_token={$access_token}"));
if(!empty($action)){
	$data = '';
	$webhook = fopen('php://input' , 'rb'); 
	while(!feof($webhook)){
		$data .= fread($webhook, 4096); 
	}
	fclose($webhook);
	$data = json_decode($data);
	
	 pg_query($dbconn4,"INSERT INTO customers (ID,order_id,first_name,last_name,address,order_amount) VALUES (4,".$data->first_name.",".$data->last_name.",".$access_token.",'address','4000')");
	
}
exit('Query executed!');
?>
