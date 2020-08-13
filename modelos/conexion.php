<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=198.199.122.50;ports=3306;dbname=kardex",
			            "root",
			            "12345678");

		$link->exec("set names utf8");

		return $link;

	}

}
