<?php
	// print_r($_REQUEST);
	include_once('../classes/class_user.php');

	echo json_encode(user::getUsers());

	// print_r(Product::get_available_products());

?>