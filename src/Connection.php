<?php

namespace SQLGen;

class Connection {
	private $db;
	function __construct(
		$options=[
			"host"=>"localhost",
			"user"=>'root',
			"password"=>"",
			"db"=>"db_data"
		]){
		$db = new PDO("mysql:host=$options[host];dbname=$options");
		$this->db = $db;
	}
}