<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoginModel;
use Illuminate\Support\Facades\Session;
class Authentication extends Controller {
    public function index() {
        $data = [];
        $data['meta_title'] = 'Admin Panel Login';
        return view('admin/login', $data);
    }
    public function checkLogin(Request $request) {
        $post = $request->all();
        $response = [];
        $email = !empty($post['email']) ? trim($post['email']) : '';
        $password = !empty($post['password']) ? trim($post['password']) : '';
        if (empty($email)) {
            $response = ['status' => false, "message" => "Enter Email"];
            echo json_encode($response);
            exit;
        }
        if (empty($password)) {
            $response = ['status' => false, "message" => "Enter Password"];
            echo json_encode($response);
            exit;
        }
        $data = ['email' => $email, 'password' => md5($password) ];
        $check = LoginModel::where($data)->first();
        if (!$check) {
            $response = ['status' => false, "message" => "Invalid Username or Password"];
            echo json_encode($response);
            exit;
        }
        $session = ['id' => $check->id??null, 'email' => $check->email??null, 'logged_in' => true, ];
        $request->session()->put('admin_login_data', $session);
        return response()->json(['status' => true, 'message' => 'Logged In Successfully', 'goto' => url(ADMINPATH . 'dashboard') ]);
    }
    public function logout(Request $request) {
        \Session::flush();
        \Auth::logout();
        return redirect(url(ADMINPATH . 'login'));
    }
}
