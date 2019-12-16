# Intro
simple SQL generator
# Usage
``` 
require "./src/autoload.php";
use SQLGen\QuerySelectGenerator as SQLSelect;

$SQL = new SQLSelect("<table_name>");
```