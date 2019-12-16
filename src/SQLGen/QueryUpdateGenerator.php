<?php
namespace SQLGen;

class QueryUpdateGenerator{
    private $builder = [
        "updates"   => [
            'updateVal' =>[],
            "from"    => [],
            "where"   => [],
        ],
    ];

    public function __construct($tableName) {
        $this->builder['updates']['from'] = $tableName;
    }
    public function update($arrayVars=[['field'=>'value']])
    {
        $updates = $this->builder['updates']['updateVal'];
        foreach($arrayVars as $key=> $value){
            array_push($updates,["key"=>$key,'value'=>$value]);
        }
        $this->builder['updates']['updateVal'] = $updates;
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
        $whereNow = $builders['updates']['where'];
        if(count($whereNow)>0){
            if(! $options['isOr']){
                $wheres['isAnd']  = true;
            }else{
                $wheres['isOr']  = true;
                $wheres['isAnd']  = false;
            }
        }
        array_push($whereNow,$wheres);
        $this->builder['updates']['where'] = $whereNow;
        return $this;
    }
 
    public function sql()
    {
        $sql = "";
        $builder = json_decode(json_encode($this->builder));
        $temp = function()use($builder)
        {
            
            $update = $builder->updates->updateVal;
            $hasil = [];
            foreach ($update as $key => $value) {
                array_push($hasil,"{$value->key}='{$value->value}'");
            }
            $tmp = join(",",$hasil);
            return $tmp;
        };
        $sql = "UPDATE {$builder->updates->from} SET {$temp()}";
        $where = $builder->updates->where;
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