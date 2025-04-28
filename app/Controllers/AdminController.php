<?php

namespace App\Controllers;
use App\Controllers\BaseController;


class AdminController extends BaseController {

    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = $this->loadModel('AdminModel');
    }
    public function renderAdminDashboard() {
        $this->render('admin/dashboard');
    }

    public function renderServiceRequest() {
        $this->render('admin/service-request');
    }

    public function renderTechnician() {
        $this->render('admin/technician');
    }

    public function renderInventory(){
        $this->render('admin/inventory');
    }
    public function renderUserManagement(){
        $users = $this->adminModel->getAllUsers();
    
        // Pass the data to the view
        $this->render('admin/user-management', [
            'users' => $users
        ]);
    }

    public function renderAdminProfile(){
        $this->render('admin/profile');
    }





}

?>