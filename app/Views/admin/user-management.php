<?php
// Set page title and active tab
$title = 'User Management - AirProtect';
$activeTab = 'user_management';

// Additional styles specific to user management
$additionalStyles = '
<link href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.min.css" rel="stylesheet">
<style>
    /* CSS for user management - extracted to a separate file for cleaner code */
    @include("assets/css/user-management.css");
    
    /* Additional responsive styles */
    @media screen and (max-width: 767px) {
        .bulk-actions .btn-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
        }
        
        .dtr-details {
            width: 100%;
            padding: 10px;
        }
        
        .dtr-details li {
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }
    }
</style>';

// Additional scripts for user management functionality
$additionalScripts = '
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>    
<script src="/assets/js/javascript-query/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.min.js"></script>
<script src="/assets/js/utility/user-management.js"></script>';

// Include base template
ob_start();
?>
<script src="/assets/js/javascript-query/jquery-3.7.1.js"></script>
<!-- Main Content -->
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">User Management</h4>
        <button class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="bi bi-plus-circle me-2"></i> Add New User
        </button>
    </div>
    <link rel="stylesheet" href="/assets/css/user-management.css">
    <!-- Users Table -->
    <div class="card">
        <div class="card-body">
            <table id="usersTable" class="table align-middle table-hover display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAllUsers">
                            </div>
                        </th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Last Login</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($users) && !empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <?php 
                                // Prepare user data for display
                                $userId = $user['ua_id'];
                                $userName = htmlspecialchars($user['ua_first_name'] . ' ' . $user['ua_last_name']);
                                $userEmail = htmlspecialchars($user['ua_email']);
                                $userRole = strtolower($user['role_name']);
                                $userStatus = $user['ua_is_active'] ? 'active' : 'inactive';
                                $profileImage = $user['ua_profile_url'] ?? '/assets/images/avatar/default.jpg';
                                
                                // Determine role class for styling
                                $roleClass = '';
                                switch ($userRole) {
                                    case 'admin': $roleClass = 'role-admin'; 
                                    break;
                                    case 'technician': $roleClass = 'role-technician'; 
                                    break;
                                    case 'customer': $roleClass = 'role-customer'; 
                                    break;
                                }
                                
                                // Format last login date
                                $lastLogin = $user['ua_last_login'] 
                                    ? date('M d, Y h:i A', strtotime($user['ua_last_login'])) 
                                    : 'Never';
                            ?>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input user-checkbox" type="checkbox" data-user-id="<?= $userId ?>">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?= $profileImage ?>" alt="User Avatar" class="user-avatar me-3">
                                        <div>
                                            <p class="mb-0 fw-medium"><?= $userName ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td data-order="<?= $userEmail ?>"><?= $userEmail ?></td>
                                <td data-order="<?= $userRole ?>" data-search="<?= $userRole ?>">
                                    <span class="badge role-badge <?= $roleClass ?>"><?= ucfirst($userRole) ?></span>
                                </td>
                                <td data-order="<?= $userStatus ?>" data-search="<?= $userStatus ?>">
                                    <span class="status-<?= $userStatus ?>">
                                        <i class="bi bi-circle-fill me-1"></i> <?= ucfirst($userStatus) ?>
                                    </span>
                                </td>
                                <td data-order="<?= $user['ua_last_login'] ?? '' ?>"><?= $lastLogin ?></td>
                                <td>
                                    <!-- Action buttons dropdown inline -->
                                    <div class="dropdown">
                                        <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="#" onclick="prepareEditUser(
                                                    '<?= $userId ?>', 
                                                    '<?= htmlspecialchars(addslashes($userName)) ?>', 
                                                    '<?= htmlspecialchars(addslashes($userEmail)) ?>', 
                                                    '<?= $userRole ?>', 
                                                    '<?= $userStatus ?>'
                                                )">
                                                    <i class="bi bi-pencil me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#" onclick="resetUserPassword('<?= $userId ?>', '<?= htmlspecialchars(addslashes($userName)) ?>')">
                                                    <i class="bi bi-key me-2"></i>Reset Password
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#" onclick="prepareDeleteUser('<?= $userId ?>', '<?= htmlspecialchars(addslashes($userName)) ?>')">
                                                    <i class="bi bi-trash me-2"></i>Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No users found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Bulk Actions -->
    <div class="bulk-actions mt-3" id="bulkActionsContainer" style="display: none;">
        <div class="d-flex align-items-center flex-wrap">
            <span class="me-2 mb-2"><span id="selectedCount">0</span> users selected</span>
            <div class="btn-group">
                <button class="btn btn-sm btn-outline-secondary" id="bulkActivate">
                    <i class="bi bi-check-circle me-1"></i>Activate
                </button>
                <button class="btn btn-sm btn-outline-secondary" id="bulkDeactivate">
                    <i class="bi bi-x-circle me-1"></i>Deactivate
                </button>
                <button class="btn btn-sm btn-outline-danger" id="bulkDelete">
                    <i class="bi bi-trash me-1"></i>Delete
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<?php include __DIR__ . '/../includes/admin/modals/user-modals.php'; ?>

<!-- Add this script for bulk selection functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all checkbox functionality
    const selectAllCheckbox = document.getElementById('selectAllUsers');
    const userCheckboxes = document.querySelectorAll('.user-checkbox');
    const bulkActionsContainer = document.getElementById('bulkActionsContainer');
    const selectedCountSpan = document.getElementById('selectedCount');
    
    // Function to update bulk actions visibility and count
    function updateBulkActionsVisibility() {
        const checkedCount = document.querySelectorAll('.user-checkbox:checked').length;
        selectedCountSpan.textContent = checkedCount;
        
        if (checkedCount > 0) {
            bulkActionsContainer.style.display = 'block';
        } else {
            bulkActionsContainer.style.display = 'none';
        }
    }
    
    // Select all users
    selectAllCheckbox.addEventListener('change', function() {
        userCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateBulkActionsVisibility();
    });
    
    // Individual checkbox changes
    userCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActionsVisibility);
    });
    
    // Bulk action buttons
    document.getElementById('bulkActivate').addEventListener('click', function() {
        const selectedIds = getSelectedUserIds();
        if (selectedIds.length > 0) {
            if (confirm(`Are you sure you want to activate ${selectedIds.length} users?`)) {
                performBulkAction('activate', selectedIds);
            }
        }
    });
    
    document.getElementById('bulkDeactivate').addEventListener('click', function() {
        const selectedIds = getSelectedUserIds();
        if (selectedIds.length > 0) {
            if (confirm(`Are you sure you want to deactivate ${selectedIds.length} users?`)) {
                performBulkAction('deactivate', selectedIds);
            }
        }
    });
    
    document.getElementById('bulkDelete').addEventListener('click', function() {
        const selectedIds = getSelectedUserIds();
        if (selectedIds.length > 0) {
            if (confirm(`Are you sure you want to delete ${selectedIds.length} users? This action cannot be undone.`)) {
                performBulkAction('delete', selectedIds);
            }
        }
    });
    
    // Get selected user IDs
    function getSelectedUserIds() {
        const selectedIds = [];
        document.querySelectorAll('.user-checkbox:checked').forEach(checkbox => {
            selectedIds.push(checkbox.dataset.userId);
        });
        return selectedIds;
    }
    
    // Perform bulk action via AJAX
    function performBulkAction(action, userIds) {
        fetch('/api/users/bulk-action', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                action: action,
                user_ids: userIds
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                // Reload the page to refresh the table
                window.location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while performing the action.');
        });
    }
    
    // Initialize the DataTable with responsive features
    if ($.fn.DataTable) {
        $('#usersTable').DataTable({
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            // Extract the user name from the HTML in the User column
                            var userName = $(data[1]).find('p').text();
                            return 'Details for ' + userName;
                        }
                    }),
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: 'table table-bordered table-striped'
                    })
                }
            },
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            pageLength: 10,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search users..."
            },
            columnDefs: [
                { orderable: false, targets: [0, 6] },
                { responsivePriority: 1, targets: [1, 3, 6] }, // User, Role, Actions are high priority
                { responsivePriority: 2, targets: [4] },        // Status is medium priority
                { responsivePriority: 3, targets: [2, 5] }      // Email and Last Login are lower priority
            ],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            drawCallback: function() {
                // Re-initialize tooltips or popovers if needed
                if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                    $('.tooltip').tooltip('dispose');
                    $('[data-bs-toggle="tooltip"]').tooltip();
                }
            }
        });
        
        // Handle responsive display for checkboxes
        $('#usersTable').on('responsive-display', function(e, datatable, row, showHide, update) {
            if (showHide) {
                // When a row is expanded, we might need to initialize components in the detail view
                const rowData = datatable.row(row.index()).data();
                // Any initialization for expanded rows can go here
            }
        });
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../includes/admin/base.php';
?>