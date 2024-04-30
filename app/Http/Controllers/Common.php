<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common_model;
class Common extends Controller {
    protected $table;
    protected $c_model;
    public function __construct() {
        $this->table = 'tbl_cms_list';
        $this->c_model = new Common_model();
    }
    public function index(Request $request) {
        $url = $request->segment(1);
        $cms = $this->c_model->getSingle('tbl_cms_list', '*', ['page_slug' => $url]);
        if ($cms) {
            $this->loadCmsPage($cms, $url);
        }
    }
    public function loadCmsPage($page, $url) {
        if ($url == "about-me") {
            $data = [];
            $data['body_class'] = 'about';
            $data['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : '';
            $data['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
            $data['meta_keywords'] = !empty($page['meta_keywords']) ? $page['meta_keywords'] : '';
            $data['skills_list'] = $this->c_model->getAllData('tbl_skill_list', 'id,skill_name,percentage', ['status' => 'Active'], null, null, 'DESC', 'id');
            $data['education_list'] = $this->c_model->getAllData('tbl_education_list', 'id,pass_year,title,institution,institution_place', null, null, null, 'ASC', 'id');
            $data['experience_list'] = $this->c_model->getAllData('tbl_experience_list', 'id,from_year,to_year,position,company,description', ['status' => 'Active'], null, null, 'ASC', 'id');
            echo frontView('about', $data);
        }
        if ($url == "contact-me") {
            $data = [];
            $data['body_class'] = 'contact';
            $data['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : '';
            $data['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
            $data['meta_keywords'] = !empty($page['meta_keywords']) ? $page['meta_keywords'] : '';
            echo frontView('contact', $data);
        }
        if ($url == "portfolio") {
            $data = [];
            $data['body_class'] = 'portfolio';
            $data['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : '';
            $data['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
            $data['meta_keywords'] = !empty($page['meta_keywords']) ? $page['meta_keywords'] : '';
            $data['portfolio_list'] = $this->c_model->getAllData('tbl_portfolio_list', 'id,project_category,project_name,project_url,short_description,project_image', ['status' => 'Active']);
            echo frontView('portfolio', $data);
        }
    }
}
