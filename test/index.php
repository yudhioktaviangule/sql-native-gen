<?php 
 require "./src/autoload.php";
 use SQLGen\QuerySelectGenerator as Select;
 use SQLGen\QueryUpdateGenerator as Update;

 $updates = new Update("members");
 $x = new Select("products");
 $sql = $x->select(['id','name'])
			->where("id",1)
			->where("price",3000,">")
			->orWhere("colors","white")
			->where("name",'%Mercy%',"LIKE")
			->sql();
$sqlUpdate = $updates->update(
	[
		'name'=>'bartra',
		'age'=>32
	])->where("id",1);
 var_dump($sqlUpdate->sql()); 


	
