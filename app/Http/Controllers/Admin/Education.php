<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common_model;
class Education extends Controller
{
    protected $table;
    protected $c_model;
    public function __construct() {
        $this->table = 'tbl_education_list';
        $this->c_model = new Common_model();
    }
    public function index() {
        $data = []; 
        $data['menu'] = "Education Master"; 
        $data['title'] = "Education List";
        return adminView('education-list', $data);
    }
    function add_education(Request $request) {
        $id = $request->has('id') ? $request->input('id') : '';
        $data = [];
        $data["menu"] = "Education Master";
        $data["title"] = !empty($id) ? "Edit Education" : "Add Education";
        $savedData=[];
        $savedData = $this->c_model->getSingle($this->table, '*', ['id' => $id]);
        $data['id'] = !empty($savedData['id']) ? $savedData['id'] : $id;
        $data['pass_year'] = !empty($savedData['pass_year']) ? $savedData['pass_year'] : '';
        $data['education_title'] = !empty($savedData['title']) ? $savedData['title'] : '';
        $data['institution'] = !empty($savedData['institution']) ? $savedData['institution'] : '';
        $data['institution_place'] = !empty($savedData['institution_place']) ? $savedData['institution_place'] : '';
        $data['status'] = !empty($savedData['status']) ? $savedData['status'] : 'Active';
        return adminView('add-education', $data);
    }
    public function save_education(Request $request) {
        $post = $request->all();
        $id = $request->has('id') ? trim($request->input('id')) : '';
        $data = [];
        $response = [];
        $data['pass_year'] = trim($post['pass_year']);
        $data['title'] = trim($post['title']);
        $data['institution'] = trim($post['institution']);
        $data['institution_place'] = trim($post['institution_place']);
        $duplicate = $this->c_model->getSingle($this->table, 'id', $data);
        if (!empty($duplicate)) {
            if ($id === '' || $duplicate['id'] != $id) {
                $response['status'] = false;
                $response['message'] = 'Duplicate Entry';
                return response()->json($response);
            }
        }
        //$data['status'] = trim($post['status']);

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

        $url = url(ADMINPATH.'add-education').'?id='.$last_id;
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
            $where["pass_year LIKE '%" . $searchString . "%' OR title LIKE '%" . $searchString . "%' OR institution LIKE '%" . $searchString . "%' OR institution_place LIKE '%" . $searchString . "%' "] = null;
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