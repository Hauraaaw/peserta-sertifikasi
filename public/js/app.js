document.addEventListener('DOMContentLoaded', function () {
    // Sidebar responsif (tablet dan mobile)
    var sidebar = document.getElementById('sidebar');
    var backdrop = document.getElementById('sidebarBackdrop');
    var toggle = document.getElementById('sidebarToggle');

    function setSidebar(open) {
        if (!sidebar) return;
        sidebar.classList.toggle('open', open);
        backdrop.classList.toggle('show', open);
    }

    if (toggle) toggle.addEventListener('click', function () { setSidebar(!sidebar.classList.contains('open')); });
    if (backdrop) backdrop.addEventListener('click', function () { setSidebar(false); });

    // Modal konfirmasi hapus
    var modal = document.getElementById('deleteModal');
    if (modal) {
        modal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            document.getElementById('deleteForm').action = button.getAttribute('data-action');
            document.getElementById('deleteName').textContent = button.getAttribute('data-name');
        });
    }
});
