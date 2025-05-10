<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class AdminController extends BaseController {

    protected $adminModel;

    public function __construct()
    {
        parent::__construct();
        $this->adminModel = $this->loadModel('AdminModel');
    }
    
    /**
     * Render the admin dashboard
     */
    public function renderAdminDashboard()
    {
        // Check admin permissions
        if (!$this->checkPermission('admin')) {
            return $this->redirect('/auth/login');
        }
        
        // Fetch dashboard data if needed
        $dashboardData = [
            'title' => 'Dashboard - AirProtect Admin',
            'user' => [
                'name' => $_SESSION['user_name'] ?? 'Admin',
                'role' => $_SESSION['user_role'] ?? 'admin'
            ]
        ];
        
        $this->render('admin/dashboard', $dashboardData);
    }
    
    /**
     * Render the service requests page
     */
    public function renderServiceRequest()
    {
        // Check admin permissions
        if (!$this->checkPermission('admin')) {
            return $this->redirect('/auth/login');
        }
        
        $this->render('admin/service-request');
    }
    
    /**
     * Render the technicians page
     */
    public function renderTechnician()
    {
        // Check admin permissions
        if (!$this->checkPermission('admin')) {
            return $this->redirect('/auth/login');
        }
        
        $this->render('admin/technician');
    }
    
    /**
     * Render the inventory management page
     */
    public function renderInventory()
    {
        // Check admin permissions
        if (!$this->checkPermission('admin')) {
            return $this->redirect('/auth/login');
        }
        
        // We don't need to pass any specific data here as
        // the InventoryController handles all data loading via AJAX
        $this->render('admin/inventory');
    }
    
    /**
     * Render the user management page
     */
    public function renderUserManagement()
    {
        // Check admin permissions
        if (!$this->checkPermission('admin')) {
            return $this->redirect('/auth/login');
        }
        
        $this->render('admin/user-management');
    }
    
    /**
     * Render the admin profile page
     */
    public function renderAdminProfile()
    {
        // Check admin permissions
        if (!$this->checkPermission('admin')) {
            return $this->redirect('/auth/login');
        }
        
        $this->render('admin/profile');
    }
}

?>