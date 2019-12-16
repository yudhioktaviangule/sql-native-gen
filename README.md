# Intro
A simple library SQL generator Native PHP
# INSTALL
Download the ZIP or use
```
git clone https://github.com/yudhioktaviangule/sql-native-gen
```
# Usage
```php
<?php 
 require "./src/autoload.php";
 use SQLGen\SQLGenerator as SQL;
 $sqlGenerator = new SQL("table_name");
```
# Example
```php 
<?php 
 require "./src/autoload.php";
 use SQLGen\SQLGenerator as SQL;
 $sqlGenerator = new SQL("members");
 $sql = $sqlGenerator->update(['id'=>1,"name"=>"adamas"])->where('id',1)->sql();
 $sql1 = $sqlGenerator->select(['id','name'])->where('id',1)->sql();
 var_dump($sql);
 var_dump($sql1);

```
then it will return
```sql
"SELECT id,name FROM products WHERE id = '1' AND price > '3000' OR colors = 'white' AND name LIKE '%Mercy%' "
```