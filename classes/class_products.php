<?php

	include_once 'dbase.php';
	class Product {

		use dataBase; 
		// private $id;
		private	$name;
		private	$category;
		private $price;
		private $picture_source;
		private $availability;


		public function __construct($Name, $Category, $Price, $Picture_source, $Availability) {

			$this->name = $Name;
			$this->category = $Category;
			$this->price = $Price;
			$this->picture_source = $Picture_source;
			$this->availability = $Availability;
		}


		public function add() {

			$sql_add_product = "INSERT INTO products VALUES (NULL, ?, ?, ?, ?, ?);";

			$parameters = ["$this->name", "$this->category", "$this->price", "$this->picture_source", "$this->availability"];

			$this->manDb($sql_add_product, $parameters);
		}


		public function edit($Id) {

			$sql_edit_product = "UPDATE products
			SET
			pname = ?,
			p_CID = ?,
			price = ?,
			picture = ?,
			availability = ?
			WHERE PID = ?;";

			$parameters = ["$this->name", "$this->category", "$this->price", "$this->picture_source", "$this->availability", "$Id"];

			$this->manDb($sql_edit_product, $parameters);
		}


		public static function remove($Id) {

			$sql_remove_product = "DELETE FROM products WHERE PID = ?;";

			$parameters = ["$Id"];

			Product::manDb($sql_remove_product, $parameters);
		}


		public static function set_availability($Id, $availability) {
			
			$sql_set_availability = "UPDATE products
			SET
			availability = ?
			WHERE PID = ?;";

			$parameters = ["$availability", "$Id"];

			Product::manDb($sql_set_availability, $parameters);
		}

		public static function get_availability($Id) {
			
			$sql_get_availability = "SELECT availability FROM products
			WHERE PID = ?;";

			$parameters = ["$Id"];

			$prep = Product::manDb($sql_get_availability, $parameters);
			return $prep->fetch(PDO::FETCH_ASSOC);
		}

		public static function get_all_products() {
			
			$sql_get_all_products = "SELECT * FROM all_products;";

			$prep = Product::manDb($sql_get_all_products, array());
			return $prep->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function get_available_products() {
			
			$sql_get_available_products = "SELECT * FROM all_products WHERE availability=1";

			$prep = Product::manDb($sql_get_available_products, array());
			return $prep->fetchAll(PDO::FETCH_ASSOC);
		}

		public static function get_product($prod) {
			
			$sql_get_all_products = "SELECT * FROM products where pname=?;";

			$prep = Product::manDb($sql_get_all_products, array($prod));
			return $prep->fetch(PDO::FETCH_ASSOC);
		}

		public static function get_product_by_id($Id) {
			
			$sql_get_product = "SELECT * FROM products
			JOIN categories ON products.p_CID = categories.CID WHERE products.PID = ?";

			$prep = Product::manDb($sql_get_product, array($Id));
			return $prep->fetch(PDO::FETCH_ASSOC);
		}
		
	// 	public function edit_product($pId) {

	// 		$query = "UPDATE Products SET pname = ? , p_CID = ? , price = ? , picture = ? , availability = ?
	// 		where PID = $pId";
	// 		$parameters=["$this->name", "$this->category", "$this->price", "$this->picture_source", "$this->availability"];
	// 		$this->manDb($query,$parameters);
	// 	}

	}

?>