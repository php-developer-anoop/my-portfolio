<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class Dashboard extends Controller {
    public function index() {
        $data = [];
        $data['title'] = 'Dashboard';
        return adminView('dashboard', $data);
    }
}
