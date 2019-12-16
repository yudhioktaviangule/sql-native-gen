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
then it will return
```sql
"SELECT id,name FROM products WHERE id = '1' AND price > '3000' OR colors = 'white' AND name LIKE '%Mercy%' "
```