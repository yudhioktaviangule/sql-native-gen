<?php
namespace SQLGen;
class QueryDeleteGenerator{
    private $builder = [
        "deletes"   => [
            "from"    => [],
            "where"   => [],
        ],
    ];

    public function __construct($tableName) {
        $this->builder['deletes']['from'] = $tableName;
    }
    public function delete()
    {
        return $this;
    }
    public function orWhere($field,$value,$operator='=')
    {
        return $this->where($field,$value,$operator,['isOr'=>true]);
    }
    public function where($field,$value,$operator='=',$options=['isOr'=>false])
    {
        $wheres   = [];
        $builders = $this->builder;
        $wheres   = ['operator'=>$operator,'field' => $field,'value' => $value,'isOr'=>false,'isAnd'=>false];
        $whereNow = $builders['deletes']['where'];
        if(count($whereNow)>0){
            if(! $options['isOr']){
                $wheres['isAnd']  = true;
            }else{
                $wheres['isOr']  = true;
                $wheres['isAnd']  = false;
            }
        }
        array_push($whereNow,$wheres);
        $this->builder['deletes']['where'] = $whereNow;
        return $this;
    }
 
    public function sql()
    {
        $sql = "";
        $builder = json_decode(json_encode($this->builder));
        $sql = "DELETE FROM {$builder->deletes->from}";
        $where = $builder->deletes->where;
        $temp = "";
        if(count($where)>0){
            $andor = "";
            foreach ($where as $key => $value) {
                if($key>0){
                    $andor = " AND {$value->field} {$value->operator} '{$value->value}'";
                    if ($value->isOr) {
                        $andor = " OR {$value->field} {$value->operator} '{$value->value}'";
                    }
                    $temp.=$andor;
                }else{
                    $temp ="WHERE {$value->field} {$value->operator} '{$value->value}'";
                }
            }
        }else{
            $temp="";
        }
   
        $sql   = "$sql $temp";
        return $sql;
    }    

}