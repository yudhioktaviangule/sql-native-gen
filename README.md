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
i ran testing at the test directory
```php 
<?php 
 require_once __DIR__ . '/../vendor/autoload.php';
 use SQLGen\SQLGenerator as SQL;

 $sqlGenerator = new SQL("members");
 $sql = $sqlGenerator->update(['id'=>1,"name"=>"adamas"])->where('id',1)->sql();
 $sql1 = $sqlGenerator->select(['id','name'])->where('id',1)->sql();

printf("%s \n",$sql);
printf("%s \n",$sql1);
```
then it will return
```sql
UPDATE members SET id='1',name='adamas' WHERE id = '1' 
SELECT id,name FROM members WHERE id = '1'  
```