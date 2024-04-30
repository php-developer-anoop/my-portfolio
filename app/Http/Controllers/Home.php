<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common_model;
class Home extends Controller {
    protected $c_model;
    public function __construct() {
        $this->c_model = new Common_model();
    }
    public function index() {
        $data = [];
        $company = webSetting('*');
        $data['body_class'] = 'home';
        $data['meta_title'] = $company['first_name'] . ' ' . $company['last_name'];
        $data['meta_description'] = $company['first_name'] . ' ' . $company['last_name'];
        $data['meta_keywords'] = $company['first_name'] . ' ' . $company['last_name'];
        return frontView('index', $data);
    }
    function getRandomCaptcha() {
        $captua_token = random_alphanumeric_string(6);
        echo $captua_token;
    }
    public function saveQuery(Request $request) {
        $post = $request->all();
        $name = !empty($post['name']) ? testInput(trim($post['name'])) : '';
        $email = !empty($post['email']) ? testInput(trim($post['email'])) : '';
        $subject = !empty($post['subject']) ? testInput(trim($post['subject'])) : '';
        $message = !empty($post['message']) ? testInput(trim($post['message'])) : '';
        $entered_captcha = !empty($post['entered_captcha']) ? testInput(trim($post['entered_captcha'])) : '';
        $csrf = !empty($post['csrf']) ? testInput(trim($post['csrf'])) : '';
        if (empty($name)) {
            $response = ['status' => false, 'message' => 'Enter Your Name'];
            echo json_encode($response);
            exit;
        }
        if (empty($email)) {
            $response = ['status' => false, 'message' => 'Enter Your Email'];
            echo json_encode($response);
            exit;
        }
        if (empty($subject)) {
            $response = ['status' => false, 'message' => 'Enter Subject'];
            echo json_encode($response);
            exit;
        }
        if (empty($message)) {
            $response = ['status' => false, 'message' => 'Enter Detailed Message'];
            echo json_encode($response);
            exit;
        }
        if (empty($entered_captcha)) {
            $response = ['status' => false, 'message' => 'Enter Captcha'];
            echo json_encode($response);
            exit;
        }
        if (($entered_captcha) !== ($csrf)) {
            $response = ['status' => false, 'message' => 'Invalid Captcha'];
            echo json_encode($response);
            exit;
        }
        $saveData = [];
        $saveData['name'] = $name;
        $saveData['email'] = $email;
        $saveData['subject'] = $subject;
        $saveData['message'] = $message;
        $saveData['add_date'] = date('Y-m-d H:i:s');

        $last_id = $this->c_model->insertRecords('tbl_enquiry_list', $saveData);

        if ($last_id) {
            $response = ['status' => true, 'message' => 'Query Submitted Successfully'];
            echo json_encode($response);
            exit;
        } else {
            $response = ['status' => true, 'message' => 'Something Went Wrong'];
            echo json_encode($response);
            exit;
        }
    }
}
