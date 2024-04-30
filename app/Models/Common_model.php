<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Common_model extends Model {
    use HasFactory;
    public $table = 'tbl_websetting';
    public $primaryKey = 'id';
    public $fillable = [];
    public function insertRecords($table, $data) {
        return DB::table($table)->insertGetId($data);
    }
    public function getSingle($table, $select = null, $where = null, $orderBy = null, $joinTable = null, $joinCondition = null) {
        $query = DB::table($table);
        
        if (!is_null($select)) {
            $query->select($select);
        }
        if (!is_null($where)) {
            $query->where($where);
        }
        if (!is_null($orderBy)) {
            $query->orderBy($this->primaryKey, $orderBy);
        }
        if (!is_null($joinTable) && !is_null($joinCondition)) {
            $query->join($joinTable, ...$joinCondition);
        }
        
        $result = $query->first();
        
        return $result ? (array)$result : null;
    }
    
    public function updateRecords($table, $data, $where) {
        $builder = DB::table($table);
        $builder->where($where)->update($data);
        return true;
    }
    public function countRecords($table = null, $where = null, $select = null) {
        $builder = DB::table($table);
        if (!is_null($select)) {
            $builder->select($select);
        }
        if (!is_null($where)) {
            $builder->where($where);
        }
        $count = $builder->count();
        return $count;
    }
    public function getAllData($table = null, $select = null, $where = null, $limit = null, $offset = null, $orderby = null, $key = null, $groupby = null, $joinArray = null) {
        $builder = DB::table($table);
        
        // Check if $select is not null and process it accordingly
        if (!is_null($select)) {
            // If $select is an array, pass it directly to select()
            if (is_array($select)) {
                $builder->select($select);
            } else {
                // If $select is a string, explode it by comma and pass as array to select()
                $selectColumns = explode(',', $select);
                $builder->select($selectColumns);
            }
        }
        
        if (!is_null($where)) {
            foreach ($where as $column => $value) {
                $builder->where($column, $value);
            }
        }
        if (!is_null($key)) {
            $builder->orderBy($key, $orderby);
        } elseif (is_null($key) && !is_null($orderby)) {
            $builder->orderBy($this->primaryKey, $orderby);
        }
        if (!is_null($limit)) {
            if (!is_null($offset)) {
                $builder->offset($offset);
            }
            $builder->limit($limit);
        }
        if (!is_null($groupby)) {
            $builder->groupBy($groupby);
        }
        if (!is_null($joinArray)) {
            foreach ($joinArray as $join) {
                $builder->join($join['table'], $join['join_on'], $join['join_type']);
            }
        }
        $results = $builder->get()->toArray();
        return array_map(function($item){
            return (array) $item;
        }, $results);
    }
    
    public function deleteRecords($table, $where) {
        $builder = DB::table($table);
        $builder->where($where)->delete();
        return true;
    }
    public function getfilter($table, $where = false, $limit = false, $start = false, $orderby = false, $orderbykey = false, $getorcount = false, $select = false) {
        $builder = DB::table($table);
        if (!empty($select)) {
            $builder->select($select);
        }
        if (!empty($where)) {
            foreach ($where as $column => $value) {
                $builder->where($column, $value);
            }
        }
        if ($limit !== false) {
            if ($start !== false) {
                $builder->offset($start);
            }
            $builder->limit($limit);
        }
        if ($orderby !== false && $orderbykey !== false) {
            $builder->orderBy($orderbykey, $orderby);
        }
        if ($getorcount !== false) {
            if ($getorcount == "count") {
                return $builder->count();
            } elseif ($getorcount == "get") {
                return $builder->get()->toArray();
            }
        }
    }
    public function insertBatchItems($table, $data) {
        if (!empty($data)) {
            DB::table($table)->insert($data);
        }
    }
}
