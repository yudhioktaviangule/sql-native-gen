# Intro
A simple library SQL generator Native PHP
# INSTALL
Download the ZIP or use
```
composer create-project yudhigule/sql-gen
```
# Usage
```php
<?php 
 require_once __DIR__ . '/../vendor/autoload.php';
 use SQLGen\SQLGenerator as SQL;
 $sqlGenerator = new SQL("table_name");
```
# Example
For example I ran testing at the test directory
```php 
<?php 
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
```
then it will return
```sql
INSERT INTO members(id,name,email,age) VALUES('1','yudhigule','yudhigule@sqlgen.com','24') 
UPDATE members SET id='1',name='yudhigule',email='yudhigule@sqlgen.com',age='24' WHERE name = 'yudhigule' AND age > '24' 
SELECT id,name FROM members WHERE id = '1'  
DELETE FROM members WHERE id = '1' 
```