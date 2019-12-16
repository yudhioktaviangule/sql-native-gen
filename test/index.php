<?php 
 require "./src/autoload.php";
 use SQLGen\SQLGenerator as SQL;

 $sqlGenerator = new SQL("members");
 $sql = $sqlGenerator->update(['id'=>1,"name"=>"adamas"])->where('id',1)->sql();
 $sql1 = $sqlGenerator->select(['id','name'])->where('id',1)->sql();

 var_dump($sql);
 var_dump($sql1);
