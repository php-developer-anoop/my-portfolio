<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common_model;
class Skills extends Controller
{
    protected $table;
    protected $c_model;
    public function __construct() {
        $this->table = 'tbl_skill_list';
        $this->c_model = new Common_model();
    }
    public function index() {
        $data = []; 
        $data['menu'] = "Skill Master"; 
        $data['title'] = "Skill List";
        return adminView('skill-list', $data);
    }
    function add_skill(Request $request) {
        $id = $request->has('id') ? $request->input('id') : '';
        $data = [];
        $data["menu"] = "Skill Master";
        $data["title"] = !empty($id) ? "Edit Skill" : "Add Skill";
        $savedData=[];
        $savedData = $this->c_model->getSingle($this->table, '*', ['id' => $id]);
        $data['id'] = !empty($savedData['id']) ? $savedData['id'] : $id;
        $data['skill_name'] = !empty($savedData['skill_name']) ? $savedData['skill_name'] : '';
        $data['percentage'] = !empty($savedData['percentage']) ? $savedData['percentage'] : '';
       
        $data['status'] = !empty($savedData['status']) ? $savedData['status'] : 'Active';
        return adminView('add-skill', $data);
    }
    public function save_skill(Request $request) {
        $post = $request->all();
        $id = $request->has('id') ? trim($request->input('id')) : '';
        $data = [];
        $response = [];
        $data['skill_name'] = ucwords(trim($post['skill_name']));
        $duplicate = $this->c_model->getSingle($this->table, 'id', $data);
        if (!empty($duplicate)) {
            if ($id === '' || $duplicate['id'] != $id) {
                $response['status'] = false;
                $response['message'] = 'Duplicate Entry';
                return response()->json($response);
            }
        }
        $data['percentage'] = trim($post['percentage']);
        $data['status'] = trim($post['status']);

        if (empty($id)) {
            $data['created_at'] = date('Y-m-d H:i:s');
            $last_id = $this->c_model->insertRecords($this->table, $data);
            $message = 'Data Added Successfully';
        } else {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->c_model->updateRecords($this->table, $data, ['id' => $id]);
            $last_id = $id;
            $message = 'Data Updated Successfully';
        }

        $url = url(ADMINPATH.'add-skill').'?id='.$last_id;
        $response['status'] = true;
        $response['message'] = $message;
        $response['url'] = $url;
        return response()->json($response);
    }
    public function getRecords(Request $request) {
        $post = $request->all();
        $get = $request->all();
        $limit = (int)(!empty($get["length"]) ? $get["length"] : 1);
        $start = (int)(!empty($get["start"]) ? $get["start"] : 0);
        $is_count = !empty($post["is_count"]) ? $post["is_count"] : "";
        $totalRecords = !empty($get["recordstotal"]) ? $get["recordstotal"] : 0;
        $orderby = "DESC";
        $where = [];
        $searchString = null;
        if (!empty($get["search"]["value"])) {
            $searchString = trim($get["search"]["value"]);
            $where[" skill_name LIKE '%" . $searchString . "%' OR percentage LIKE '%" . $searchString . "%'"] = null;
            $limit = 100;
            $start = 0;
        }
        $countData = $this->c_model->countRecords($this->table, $where);
        if ($is_count == "yes") {
            echo (int)(!empty($countData) ? $countData : 0);
            exit();
        }
        if (!empty($get["showRecords"])) {
            $limit = $get["showRecords"];
            $orderby = "DESC";
        }
        $select = '*';
        $listData = $this->c_model->getAllData($this->table, $select, $where, $limit, $start, $orderby, 'id');
        $result = [];
        if (!empty($listData)) {
            $i = $start + 1;
            foreach ($listData as $key => $value) {
                $push = (array)$value;
                $push["sr_no"] = $i;
                array_push($result, $push);
                $i++;
            }
        }
        $json_data = [];
        if (!empty($get["search"]["value"])) {
            $countItems = !empty($result) ? count($result) : 0;
            $json_data["draw"] = intval($get["draw"]);
            $json_data["recordsTotal"] = intval($countItems);
            $json_data["recordsFiltered"] = intval($countItems);
            $json_data["data"] = !empty($result) ? $result : [];
        } else {
            $json_data["draw"] = intval($get["draw"]);
            $json_data["recordsTotal"] = intval($totalRecords);
            $json_data["recordsFiltered"] = intval($totalRecords);
            $json_data["data"] = !empty($result) ? $result : []; 
        }
        return response()->json($json_data);
    }
}
