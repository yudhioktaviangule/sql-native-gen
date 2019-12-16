<?php
namespace SQLGen;

class QueryInsertGenerator{
    private $builder = [
        "insert"   => [
            "from"    => [],
            "where"   => [],
            "schema"  => [],
            "values"  => [],
        ],
    ];

    public function __construct($tableName) {
        $this->builder['insert']['from'] = $tableName;
    }
   
    public function insert($params)
    {
        $schema = $this->builder['insert']['schema'];
        $values = $this->builder['insert']['values'];
        foreach ($params as $key => $value) {
            array_push($schema,$key);
            array_push($values,$value);
        }
        $this->builder['insert']['schema'] = $schema;
        $this->builder['insert']['values'] = $values;
        return $this;
    }
    
    public function sql()
    {
        $sql = "";
        $table= $this->builder['insert']['from'];
        $scheme = join(',',$this->builder['insert']['schema']);
        $values = join("','",$this->builder['insert']['values']);
        $sql = "INSERT INTO $table($scheme) VALUES('$values')";
        return $sql;
    }    

}