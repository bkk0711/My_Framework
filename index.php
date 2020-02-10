<?php
	include "Model/DBConfig.php";
	$db = new Database;
	$db->connect();

	if(isset($_GET['controller'])){
		$controller = $_GET['controller'];
	}else{
		$controller = '';
	}

	switch ($controller) {
		case 'user':
			require_once('Controller/User/index.php');
			//break;
		
		// default:
		// 	# code...
		// 	break;
	}



?>