<?php
// Set page title and active tab
$title = 'User Management - AirProtect';
$activeTab = 'user_management';

// Include base template
ob_start();
include __DIR__ . '/../includes/admin/base.php';
?>
<link rel="stylesheet" href="/assets/css/user-management.css">

<!-- Main Content -->
<div class="container-fluid py-4 fade-in">
    <!-- Page Header -->
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h3 class="mb-0 fw-bold text-dark">User Management</h3>
            <p class="text-muted mb-0">Manage your system users and access permissions</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="bi bi-plus-lg me-2"></i>Add User
            </button>
        </div>
    </div>
    
    <!-- Filters & Search Row -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="roleFilter" class="form-label small text-muted">Role</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-person-badge text-muted"></i></span>
                        <select class="form-select" id="roleFilter">
                            <option value="">All Roles</option>
                            <option value="admin">Admin</option>
                            <option value="technician">Technician</option>
                            <option value="customer">Customer</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="statusFilter" class="form-label small text-muted">Status</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-toggle2-on text-muted"></i></span>
                        <select class="form-select" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="search-box w-100">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search users...">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-2">
                        <button id="applyFilters" class="btn btn-primary w-100">
                            <i class="bi bi-funnel-fill me-2"></i>Apply Filters
                        </button>
                        <button id="resetFilters" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Users Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h5 class="card-title mb-0">Users</h5>
            <span class="badge bg-light text-dark" id="userCount">Loading...</span>
        </div>
        <div class="card-body table-container">
            <!-- Using empty thead to let DataTables build it properly -->
            <table id="usersTable" class="table align-middle table-hover display nowrap" style="width:100%">
                <thead></thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="addUserModalLabel">
                    <i class="bi bi-person-plus me-2 text-primary"></i>Add New User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                                <input type="text" class="form-control border-start-0" id="first_name" name="first_name" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                                <input type="text" class="form-control border-start-0" id="last_name" name="last_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                            <input type="email" class="form-control border-start-0" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                            <input type="password" class="form-control border-start-0" id="password" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock-fill text-muted"></i></span>
                            <input type="password" class="form-control border-start-0" id="confirm_password" name="confirm_password" required>
                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="role_id" class="form-label">Role</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield text-muted"></i></span>
                                <select class="form-select border-start-0" id="role_id" name="role_id" required>
                                    <option value="">Select Role</option>
                                    <option value="3">Admin</option>
                                    <option value="2">Technician</option>
                                    <option value="1">Customer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="is_active" class="form-label">Status</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-toggle2-on text-muted"></i></span>
                                <select class="form-select border-start-0" id="is_active" name="is_active" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveUserBtn">
                    <i class="bi bi-save me-2"></i>Save User
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="editUserModalLabel">
                    <i class="bi bi-pencil-square me-2 text-warning"></i>Edit User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <input type="hidden" id="edit_user_id" name="id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_first_name" class="form-label">First Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light