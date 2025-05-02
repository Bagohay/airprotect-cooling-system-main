<?php

// Define public routes
$publicRoutes = [
    '/',
    '/login',
    '/register',
    '/contact-us',
    '/user-data',
    '/paginate-test',
    '/datable-test'
];

// Define the access control map for routes if needed
$accessMap = [
    // Admin-only routes
    '/admin/dashboard' => ['admin'],
    '/admin/service-requests' => ['admin'],
    '/admin/technicians' => ['admin'],
    '/admin/inventory' => ['admin'],
    '/admin/profile' => ['admin'],
    '/admin/user-management' => ['admin'],
    
    // User Management API routes - Admin only
    '/api/users' => ['admin'],
    '/api/users/data' => ['admin'],
    '/api/users/export' => ['admin'],
    
    // User routes
    '/user/dashboard' => ['customer'],
];

$router->setBasePath(''); // Set this if your app is in a subdirectory

// Define routes
// Home routes
$router->map('GET', '/', 'App\Controllers\HomeController#index', 'home');
$router->map('GET', '/services', 'App\Controllers\HomeController#service', 'service');
$router->map('GET', '/products', 'App\Controllers\HomeController#products', 'product');
$router->map('GET', '/about', 'App\Controllers\HomeController#about', 'about');
$router->map('GET', '/contact-us', 'App\Controllers\HomeController#contactUs', 'contact');
$router->map('POST', '/contact-us', 'App\Controllers\HomeController#contactUs', 'contact_post');
$router->map('GET', '/privacy-policy', 'App\Controllers\HomeController#privacy', 'privacy-policy');
$router->map('GET', '/terms-of-service', 'App\Controllers\HomeController#terms', 'terms-of-service');

// Auth routes
$router->map('GET', '/auth/login', 'App\Controllers\AuthController#renderLogin', 'render_login');
$router->map('POST', '/auth/login', 'App\Controllers\AuthController#loginAccount', 'login_post');
$router->map('GET', '/auth/register', 'App\Controllers\AuthController#renderRegister', 'render_register');
$router->map('POST', '/auth/register', 'App\Controllers\AuthController#registerAccount', 'register_post');
$router->map('GET', '/auth/reset-password', 'App\Controllers\AuthController#renderResetPassword', 'reset_password');
$router->map('GET', '/auth/logout', 'App\Controllers\AuthController#logout', 'logout');

// User routes
$router->map('GET', '/user/dashboard', 'App\Controllers\UserController#renderUserDashboard', 'render_user-dashboard');

// Admin routes
$router->map('GET', '/admin/dashboard', 'App\Controllers\AdminController#renderAdminDashboard', 'render_admin-dashboard');
$router->map('GET', '/admin/service-requests', 'App\Controllers\AdminController#renderServiceRequest', 'render-service_request');
$router->map('GET', '/admin/technicians', 'App\Controllers\AdminController#renderTechnician', 'render-technician');
$router->map('GET', '/admin/inventory', 'App\Controllers\AdminController#renderInventory', 'render-Inventory');
$router->map('GET', '/admin/profile', 'App\Controllers\AdminController#renderAdminProfile', 'render-Myprofile');
$router->map('GET', '/admin/user-management', 'App\Controllers\UserManagementController#index', 'render-User_management');

// User Management API Routes
$router->map('GET', '/api/users', 'App\Controllers\UserManagementController#getUsers', 'api_get_users');
$router->map('GET', '/api/users/data', 'App\Controllers\UserManagementController#getUsersData', 'api_get_users_data');
$router->map('GET', '/api/users/[i:id]', 'App\Controllers\UserManagementController#getUser', 'api_get_user');
$router->map('POST', '/api/users', 'App\Controllers\UserManagementController#createUser', 'api_create_user');
$router->map('PUT', '/api/users/[i:id]', 'App\Controllers\UserManagementController#updateUser', 'api_update_user');
$router->map('DELETE', '/api/users/[i:id]', 'App\Controllers\UserManagementController#deleteUser', 'api_delete_user');
$router->map('POST', '/api/users/reset-password/[i:id]', 'App\Controllers\UserManagementController#resetPassword', 'api_reset_password');
$router->map('GET', '/api/users/export', 'App\Controllers\UserManagementController#exportUsers', 'api_export_users');
$router->map('POST', '/api/users/bulk-action', 'App\Controllers\UserManagementController#bulkAction', 'api_bulk_action');

// Test routes
$router->map('GET', '/test', 'App\Controllers\TestController#renderTest', 'test');