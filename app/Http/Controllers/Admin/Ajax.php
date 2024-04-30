<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common_model;
class Ajax extends Controller
{ 
    protected $c_model;
    
    public function __construct(){
        $this->c_model = new Common_model;
    }
    public function index(Request $request) {
        $keyword = $request->input("keyword");
        if (empty($keyword)) {
            return '';
        } 
        $slug = validate_slug($keyword);
        return $slug;
    }
    public function changeStatus(Request $request) {
        $id = !empty($request->has("id")) ? $request->input("id") : "";
        $table = !empty($request->has("table")) ? $request->input("table") : "";
        $records = $this->c_model->getSingle($table, 'status', ['id' => $id]);
        if (!empty($records)) {
            $current_status = $records['status'];
            if ($current_status == "Active") {
                $data['status'] = "Inactive";
            } else {
                $data['status'] = "Active";
            }
            $this->c_model->updateRecords($table, $data, ['id' => $id]);
            echo $data['status'];
        }
    }
}
