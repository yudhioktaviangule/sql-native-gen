<?php 
 require "./src/autoload.php";
 use SQLGen\SQLGenerator as SQL;

 $sqlGenerator = new SQL("members");
 $sql = $sqlGenerator->update(['id'=>1,"name"=>"adamas"])->where('id',1)->sql();

