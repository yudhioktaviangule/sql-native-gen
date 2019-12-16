<?php
namespace SQLGen;

class QuerySelectGenerator{
	private $builder = [
    
        "selects"   => [
            "select"  => [],
            "from"    => [],
            "where"   => [],
            "limit" => 0,
            "offset" => 0,
            "groupBy" => [],
            "orderBy" => [],

        ],
        
    ];

    public function __construct($tableName) {
        $this->builder['selects']['from'] = $tableName;
    }

    public function where($field,$value,$operator='=',$options=['isOr'=>false])
    {
        $wheres   = [];
        $builders = $this->builder;
        $wheres   = ['operator'=>$operator,'field' => $field,'value' => $value,'isOr'=>false,'isAnd'=>false];
        $whereNow = $builders['selects']['where'];
        if(count($whereNow)>0){
            if(! $options['isOr']){
                $wheres['isAnd']  = true;
            }else{
                $wheres['isOr']  = true;
                $wheres['isAnd']  = false;
            }
        }
        array_push($whereNow,$wheres);
        $this->builder['selects']['where'] = $whereNow;
        return $this;
    }

    public function select($fields=[])
    {
        $selects = $this->builder['selects']['select'];
        foreach ($fields as $key => $value) {
            array_push($selects,$value);
        }

        $this->builder['selects']['select'] = $selects;
        return $this;
    }
    public function limit($limit)
    {
        $this->builder['selects']['limit']=$limit;
        return $this;
    }
    public function orWhere($field,$value,$operator='=')
    {
        return $this->where($field,$value,$operator,['isOr'=>true]);
    }
    
    public function offset($offset)
    {
        $this->builder['selects']['offset']=$offset;
        return $this;
    }

    public function sql()
    {
        $sql = "";
        $builder = json_decode(json_encode($this->builder));
        $temp = function()use($builder)
        {
            $tmp = "";
            $select = $builder->selects->select;
            if(count($select)>0){
                $tmp = join(',',$select);
            }else{
                $tmp = "*";
            }
            return $tmp;
        };
        $sql = "SELECT {$temp()} FROM {$builder->selects->from}";
        $where = $builder->selects->where;
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
        $sql    = "$sql $temp";
        $limit  = $builder->selects->limit;
        $offset = $builder->selects->offset;
        $temp   = "";
        if($limit>0){
            $temp = "LIMIT $limit";
            if($offset>0){
                $temp = "LIMIT $limit OFFSET $offset";
            }
        }   
        $sql   = "$sql $temp";
        return $sql;
    }
}
