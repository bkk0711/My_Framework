<?php
	if(isset($_GET['action'])){
		$action = $_GET['action'];
	}else{
		$action = '';
	}

	switch ($action) {
		case 'add':
			require_once('View/User/add.php');
			break;

		case 'edit':
			require_once('View/User/edit.php');
			break;
		
		case 'delete':
			require_once('View/User/delete.php');
			break;
		
		// default:
		// 	# code...
		// 	break;
	}