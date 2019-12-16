<?php 
 require_once __DIR__ . '/../vendor/autoload.php';
 use SQLGen\SQLGenerator as SQL;

 $sqlGenerator = new SQL("members");
 $insertParams = [
	 "id"=>1,
	 "name"=>'yudhigule',
	 'email'=>'yudhigule@sqlgen.com',
	 'age'=>24
 ];
 $sqlInsert = $sqlGenerator->create($insertParams)->sql();
 $sqlUpdate = $sqlGenerator->update($insertParams)
				 ->where("name","yudhigule")
				 ->where("age",24,'>')
				 ->sql();
 $sqlSelect = $sqlGenerator->select(['id','name'])->where('id',1)->sql();
 $sqlDelete = $sqlGenerator->delete()->where('id',1)->sql();
printf("%s \n",$sqlInsert);
printf("%s \n",$sqlUpdate);
printf("%s \n",$sqlSelect);
printf("%s \n",$sqlDelete);