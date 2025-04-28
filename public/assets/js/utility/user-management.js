$(document).ready(function() {
    // Initialize DataTable
    var table = $("#usersTable").DataTable({
        responsive: true,
        "pageLength": 10,
        "language": {
            "search": "",
            "searchPlaceholder": "Search users...",
            "lengthMenu": "Show _MENU_ entries",
            "info": "Showing _START_ to _END_ of _TOTAL_ users"
        },
        "columnDefs": [
            { "orderable": false, "targets": [0, 6] }
        ],
        "order": [[1, "asc"]]
    });
    
    // Select all checkbox functionality
    $("#selectAllUsers").click(function() {
        $(".user-checkbox").prop("checked", $(this).prop("checked"));
        updateBulkActionState();
    });
    
    // Individual checkbox change event
    $(document).on("change", ".user-checkbox", function() {
        updateBulkActionState();
        
        // If not all checkboxes are checked, uncheck the "select all" checkbox
        if (!$(this).prop("checked")) {
            $("#selectAllUsers").prop("checked", false);
        }
        
        // If all individual checkboxes are checked, check the "select all" checkbox
        if ($(".user-checkbox:checked").length === $(".user-checkbox").length) {
            $("#selectAllUsers").prop("checked", true);
        }
    });
    
    // Update bulk action buttons state
    function updateBulkActionState() {
        let checkedCount = $(".user-checkbox:checked").length;
        if (checkedCount > 0) {
            $("#bulkActionsBtn").prop("disabled", false);
            $("#bulkActionsSelect").prop("disabled", false);
            $("#bulkActionsApply").prop("disabled", false);
        } else {
            $("#bulkActionsBtn").prop("disabled", true);
            $("#bulkActionsSelect").prop("disabled", true);
            $("#bulkActionsApply").prop("disabled", true);
        }
    }
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});

// Initialize modals
var addUserModal = new bootstrap.Modal(document.getElementById("addUserModal"));
var editUserModal = new bootstrap.Modal(document.getElementById("editUserModal"));
var deleteUserModal = new bootstrap.Modal(document.getElementById("deleteUserModal"));

// Function to prepare edit modal with user data
function prepareEditUser(userId, name, email, role, status) {
    document.getElementById("editUserId").value = userId;
    document.getElementById("editName").value = name;
    document.getElementById("editEmail").value = email;
    document.getElementById("editRole").value = role;
    document.getElementById("editStatus").value = status;
    editUserModal.show();
}

// Function to prepare delete modal with user data
function prepareDeleteUser(userId, name) {
    document.getElementById("deleteUserId").value = userId;
    document.getElementById("deleteUserName").textContent = name;
    deleteUserModal.show();
}

// Function to reset password
function resetUserPassword(userId, name) {
    // You can implement password reset logic or show a confirmation
    alert("Reset password functionality will be implemented for " + name);
}