<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

<?php if (isset($additionalScripts)): ?>

    <?= $additionalStyles = '
<link href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet">
<style>
    .role-badge {
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 12px;
    }
    /* Keep the rest of your existing styles... */
</style>';

$additionalScripts = '
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
<script>
    // Initialize DataTable
    $(document).ready(function() {
        $("#usersTable").DataTable({
            responsive: true,
            "pageLength": 10,
            "language": {
                "search": "Search:",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ users"
            }
        });
        
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll(\'[data-bs-toggle="tooltip"]\'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Rest of your existing script...
    });
    
    // Keep your existing modal functions...
</script>'  ;  

?>


<?php endif; ?>