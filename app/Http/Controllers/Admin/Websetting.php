<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common_model;

class Websetting extends Controller
{
   
    protected $table;
    protected $c_model;
    public function __construct() {
        $this->table = 'tbl_websetting';
        $this->c_model = new Common_model();
    
    }
     public function index(){
        $data=[];
        $data['title']="Websetting";
        $data['web']=json_decode(json_encode(webSetting('*')),true);
        return adminView('web-setting',$data);
    }
    public function save_websetting(Request $request){ 
        $post=$request->all();
       
        $data=[];
        $id=!empty($post['id'])?trim($post['id']):'';
        $data['first_name']=!empty($post['first_name'])?trim($post['first_name']):'';
        $data['last_name']=!empty($post['last_name'])?trim($post['last_name']):'';
        $data['age']=!empty($post['age'])?trim($post['age']):'';
        $data['experience']=!empty($post['experience'])?trim($post['experience']):'';
        $data['linkedin_link']=!empty($post['linkedin_link'])?trim($post['linkedin_link']):'';
        $data['facebook_link']=!empty($post['facebook_link'])?trim($post['facebook_link']):'';
        $data['twitter_link']=!empty($post['twitter_link'])?trim($post['twitter_link']):'';
        $data['mobile_number']=!empty($post['mobile_number'])?trim($post['mobile_number']):'';
        $data['email']=!empty($post['email'])?trim($post['email']):'';
        $data['address']=!empty($post['full_address'])?trim($post['full_address']):'';
        $data['role']=!empty($post['role'])?trim($post['role']):'';
        $data['short_description']=!empty($post['short_description'])?trim($post['short_description']):'';
        
        
        if ($file = $request->file('profile_image')) {
            if ($file->isValid()) {
                $filename = $file->hashName();
                if (is_file(public_path('uploads/' . $post['old_profile_image']))) {
                    @unlink(public_path('uploads/' . $post['old_profile_image']));
                }
                
                $file->move(public_path('uploads/'), $filename);
                $data['profile_image'] = $filename;
         
            }
        }
        if ($file = $request->file('resume')) {
            if ($file->isValid()) {
                $filename = $file->hashName();
                if (is_file(public_path('uploads/' . $post['old_resume']))) {
                    @unlink(public_path('uploads/' . $post['old_resume']));
                }
                $file->move(public_path('uploads/'), $filename);
                $data['resume'] = $filename;
            }
        }
        // echo "<pre>";
        // print_r($data);die;

        if (empty($id)) {
            $data['created_at']=date('Y-m-d H:i:s');
            $last_id = $this->c_model->insertRecords($this->table, $data); // Assuming you're using Eloquent ORM
            $request->session()->flash('success', 'Data Added Successfully!');
        } else {
            $data['updated_at']=date('Y-m-d H:i:s');
            $this->c_model->updateRecords($this->table, $data, ['id' => $id]);
            $request->session()->flash('success', 'Data Updated Successfully!');
        }
        
        return redirect()->to(url(ADMINPATH.'websetting'));
                
    }
}
