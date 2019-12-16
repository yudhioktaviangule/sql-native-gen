# Intro
simple SQL generator Library for PHP
# INSTALL
simple SQL generator Library for PHP
# Usage
```php
<?php 
require "./src/autoload.php";
use SQLGen\QuerySelectGenerator as SQLSelect;

$SQL = new SQLSelect("<table_name>");
```
# Example
```php
<?php 
require "./src/autoload.php";
use SQLGen\QuerySelectGenerator as SQLSelect;

$SQL = new SQLSelect("products");

$sql = $SQL->select(['id','name'])
    ->where("id",1)
    ->where("price",3000,">")
    ->orWhere("colors","white")
    ->where("name",'%Mercy%',"LIKE")
    ->sql();
var_dump($sql);

```
it will return
```sql
string(107) "SELECT id,name FROM products WHERE id = '1' AND price > '3000' OR colors = 'white' AND name LIKE '%Mercy%' "
```