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
    
    // Inventory Management API routes - Admin only
    '/inventory/getAllInventory' => ['admin'],
    '/inventory/getInventoryByProduct' => ['admin'],
    '/inventory/getInventoryByWarehouse' => ['admin'],
    '/inventory/getInventoryByType' => ['admin'],
    '/inventory/getLowStockProducts' => ['admin'],
    '/inventory/getStats' => ['admin'],
    '/inventory/getWarehouses' => ['admin'],
    '/inventory/getProductsWithVariants' => ['admin'],
    '/inventory/addStock' => ['admin'],
    '/inventory/moveStock' => ['admin'],
    '/inventory/viewProduct' => ['admin'],
    '/inventory/exportInventory' => ['admin'],
    '/inventory/importInventory' => ['admin'],
    '/inventory/createProduct' => ['admin'],
    '/inventory/updateProduct' => ['admin'],
    '/inventory/deleteProduct' => ['admin'],
    
    // Warehouse Management API routes - Admin only
    '/warehouse/getAllWarehouses' => ['admin'],
    '/warehouse/getWarehouse' => ['admin'],
    '/warehouse/createWarehouse' => ['admin'],
    '/warehouse/updateWarehouse' => ['admin'],
    '/warehouse/deleteWarehouse' => ['admin'],
    '/warehouse/getWarehouseInventory' => ['admin'],
    '/warehouse/getWarehousesWithSummary' => ['admin'],
    '/warehouse/getWarehousesWithLowStock' => ['admin'],
    
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

// Inventory Management API Routes
$router->map('GET', '/inventory/getAllInventory', 'App\Controllers\InventoryController#getAllInventory', 'inventory_get_all');
$router->map('GET', '/inventory/getInventoryByProduct/[i:productId]', 'App\Controllers\InventoryController#getInventoryByProduct', 'inventory_by_product');
$router->map('GET', '/inventory/getInventoryByWarehouse/[i:warehouseId]', 'App\Controllers\InventoryController#getInventoryByWarehouse', 'inventory_by_warehouse');
$router->map('GET', '/inventory/getInventoryByType/[*:type]', 'App\Controllers\InventoryController#getInventoryByType', 'inventory_by_type');
$router->map('GET', '/inventory/getLowStockProducts', 'App\Controllers\InventoryController#getLowStockProducts', 'inventory_low_stock');
$router->map('GET', '/inventory/getStats', 'App\Controllers\InventoryController#getStats', 'inventory_stats');
$router->map('GET', '/inventory/getWarehouses', 'App\Controllers\InventoryController#getWarehouses', 'inventory_warehouses');
$router->map('GET', '/inventory/getProductsWithVariants', 'App\Controllers\InventoryController#getProductsWithVariants', 'inventory_products_variants');
$router->map('POST', '/inventory/addStock', 'App\Controllers\InventoryController#addStock', 'inventory_add_stock');
$router->map('POST', '/inventory/moveStock', 'App\Controllers\InventoryController#moveStock', 'inventory_move_stock');
$router->map('GET', '/inventory/viewProduct/[i:productId]', 'App\Controllers\InventoryController#viewProduct', 'inventory_view_product');
$router->map('GET', '/inventory/exportInventory', 'App\Controllers\InventoryController#exportInventory', 'inventory_export');
$router->map('POST', '/inventory/importInventory', 'App\Controllers\InventoryController#importInventory', 'inventory_import');
$router->map('POST', '/inventory/createProduct', 'App\Controllers\InventoryController#createProduct', 'inventory_create_product');
$router->map('PUT', '/inventory/updateProduct/[i:productId]', 'App\Controllers\InventoryController#updateProduct', 'inventory_update_product');
$router->map('POST', '/inventory/deleteProduct/[i:productId]', 'App\Controllers\InventoryController#deleteProduct', 'inventory_delete_product');

// Warehouse Management API Routes
$router->map('GET', '/warehouse/getAllWarehouses', 'App\Controllers\WarehouseController#getAllWarehouses', 'warehouse_get_all');
$router->map('GET', '/warehouse/getWarehouse/[i:warehouseId]', 'App\Controllers\WarehouseController#getWarehouse', 'warehouse_get_by_id');
$router->map('POST', '/warehouse/createWarehouse', 'App\Controllers\WarehouseController#createWarehouse', 'warehouse_create');
$router->map('PUT', '/warehouse/updateWarehouse/[i:warehouseId]', 'App\Controllers\WarehouseController#updateWarehouse', 'warehouse_update');
$router->map('POST', '/warehouse/deleteWarehouse/[i:warehouseId]', 'App\Controllers\WarehouseController#deleteWarehouse', 'warehouse_delete');
$router->map('GET', '/warehouse/getWarehouseInventory/[i:warehouseId]', 'App\Controllers\WarehouseController#getWarehouseInventory', 'warehouse_inventory');
$router->map('GET', '/warehouse/getWarehousesWithSummary', 'App\Controllers\WarehouseController#getWarehousesWithSummary', 'warehouse_summary');
$router->map('GET', '/warehouse/getWarehousesWithLowStock', 'App\Controllers\WarehouseController#getWarehousesWithLowStock', 'warehouse_low_stock');

// Test routes
$router->map('GET', '/test', 'App\Controllers\HomeController#renderTest', 'test');