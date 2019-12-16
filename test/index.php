<?php 
 require "./src/autoload.php";
 use SQLGen\QuerySelectGenerator as SQLSelect;

 $x = new SQLSelect("products");
 $sql = $x->select(['id','name'])
			->where("id",1)
			->where("price",3000,">")
			->orWhere("colors","white")
			->where("name",'%Mercy%',"LIKE")
			->sql();
 var_dump($sql); 


	
