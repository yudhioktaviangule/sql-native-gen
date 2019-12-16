<?php 
 require "./src/autoload.php";
 use SQLGen\QuerySelectGenerator as SQLSelect;

 $x = new SQLSelect("products");
 $sql = $x->select(['id',"name"])
 		  ->where("id",4)
 		  ->orWhere("price",'30000','>')
 		  ->where("name",'%anchor%','LIKE');
 var_dump($sql->sql()); 


	
