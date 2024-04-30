<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common_model;
class Portfolio extends Controller
{
    protected $table;
    protected $c_model;
    public function __construct() {
        $this->table = 'tbl_portfolio_list';
        $this->c_model = new Common_model();
    }
    public function index() {
        $data = []; 
        $data['menu'] = "Portfolio Master"; 
        $data['title'] = "Portfolio List";
        return adminView('portfolio-list', $data);
    }
    function add_portfolio(Request $request) {
        $id = $request->has('id') ? $request->input('id') : '';
        $data = [];
        $data["menu"] = "Portfolio Master";
        $data["title"] = !empty($id) ? "Edit Portfolio" : "Add Portfolio";
        $savedData=[];
        $savedData = $this->c_model->getSingle($this->table, '*', ['id' => $id]);
        $data['id'] = !empty($savedData['id']) ? $savedData['id'] : $id;
        $data['project_category'] = !empty($savedData['project_category']) ? $savedData['project_category'] : '';
        $data['project_name'] = !empty($savedData['project_name']) ? $savedData['project_name'] : '';
        $data['project_url'] = !empty($savedData['project_url']) ? $savedData['project_url'] : '';
        $data['short_description'] = !empty($savedData['short_description']) ? $savedData['short_description'] : '';
        $data['project_image'] = !empty($savedData['project_image']) ? $savedData['project_image'] : '';
        $data['status'] = !empty($savedData['status']) ? $savedData['status'] : 'Active';
        return adminView('add-portfolio', $data);
    }
    public function save_portfolio(Request $request) {
        $post = $request->all();
        $id = $request->has('id') ? trim($request->input('id')) : '';
        $data = [];
        $response = [];
        $data['project_category'] = trim($post['project_category']);
        $data['project_name'] = trim($post['project_name']);
        $data['project_url'] = trim($post['project_url']);
        
        $duplicate = $this->c_model->getSingle($this->table, 'id', $data);
        if (!empty($duplicate)) {
            if ($id === '' || $duplicate['id'] != $id) {
                $response['status'] = false;
                $response['message'] = 'Duplicate Entry';
                return response()->json($response);
            }
        }
        if ($file = $request->file('project_image')) {
            if ($file->isValid()) {
                $filename = $file->hashName();
                if (is_file(public_path('uploads/' . $post['project_image']))) {
                    @unlink(public_path('uploads/' . $post['project_image']));
                }
                
                $file->move(public_path('uploads/'), $filename);
                $data['project_image'] = $filename;
         
            }
        }
        $data['status'] = trim($post['status']);
        $data['short_description'] = trim($post['short_description']);
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

        $url = url(ADMINPATH.'add-portfolio').'?id='.$last_id;
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
            $where["project_category LIKE '%" . $searchString . "%' OR project_name LIKE '%" . $searchString . "%'"] = null;
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
