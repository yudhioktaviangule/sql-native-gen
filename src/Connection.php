<?php

namespace SQLGen;
use \PDO;
use QuerySelectGenerator;
class Connection {
	private $db;
	function __construct(
		$options=[
			"host"=>"localhost",
			"user"=>'root',
			"pass"=>"",
			"db"=>"db_data"
		]){
		$db = new PDO("mysql:host=$options[host];dbname=$options[db]",$options['user'],$options['pass']);
		$this->db = $db;
	}

	public function FunctionName($value='')
	{
		# code...
	}
	public function destroy()
	{
		$this->db = NULL;
	}
}