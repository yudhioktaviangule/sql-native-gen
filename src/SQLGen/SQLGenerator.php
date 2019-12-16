<?php
namespace SQLGen;
use SQLGen\QuerySelectGenerator as Selects;
use SQLGen\QueryUpdateGenerator as Updates;
use SQLGen\QueryDeleteGenerator as Deletes;
use SQLGen\QueryInsertGenerator as Insert;
class SQLGenerator{
    private $table = "";
    private $selects = "";
    private $updates = "";
    private $deletes = "";
    private $insert = "";
    public function __construct($table) {
        $this->table = $table;
        $this->selects = new Selects($table);
        $this->updates = new Updates($table);
        $this->deletes = new Deletes($table);
        $this->insert = new Insert($table);
    }

    public function select($fieldVar)
    {
        return $this->selects->select($fieldVar);
    }

    public function update($fieldVar)
    {
        return $this->updates->update($fieldVar);
    }
    public function delete()
    {
        return $this->deletes->delete();
    }
    public function create($fields)
    {
        return $this->insert->insert($fields);
    }
    
}