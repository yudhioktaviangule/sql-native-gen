<?php
namespace SQLGen;
use SQLGen\QuerySelectGenerator as Selects;
use SQLGen\QueryUpdateGenerator as Updates;
class SQLGenerator{
    private $table = "";
    private $selects = "";
    private $updates = "";
    public function __construct($table) {
        $this->table = $table;
        $this->selects = new Selects($table);
        $this->updates = new Updates($table);
    }

    public function select($fieldVar)
    {
        return $this->selects->select($fieldVar);
    }

    public function update($fieldVar)
    {
        return $this->updates->update($fieldVar);
    }
}