<?php 
 require_once __DIR__ . '/../vendor/autoload.php';
 use SQLGen\SQLGenerator as SQL;

 $sqlGenerator = new SQL("members");
 $sql = $sqlGenerator->update(['id'=>1,"name"=>"adamas"])->where('id',1)->sql();
 $sql1 = $sqlGenerator->select(['id','name'])->where('id',1)->sql();

printf("%s \n",$sql);
printf("%s \n",$sql1);