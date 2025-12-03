function confirmLogout() {
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: 'Apakah Anda yakin ingin keluar dari sistem admin?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3b82f6',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-xl'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }

    // Handle responsive sidebar
    document.addEventListener('DOMContentLoaded', function() {
        const checkScreenSize = () => {
            const data = Alpine.$data(document.querySelector('[x-data]'));
            if (window.innerWidth < 1024 && data.sidebarOpen) {
                data.sidebarOpen = false;
            }
        };
        
        window.addEventListener('resize', checkScreenSize);
        checkScreenSize();
        
        // Set active menu based on current URL
        const currentPath = window.location.pathname;
        const menuItems = {
            '/admin/dashboard': 'dashboard',
            '/admin/barang': 'data-barang',
            '/admin/permintaan': 'permintaan',
            '/admin/permintaan/riwayat': 'riwayat',
            '/admin/laporan': 'laporan'
        };
        
        const data = Alpine.$data(document.querySelector('[x-data]'));
        for (const [path, menu] of Object.entries(menuItems)) {
            if (currentPath.startsWith(path)) {
                data.activeMenu = menu;
                break;
            }
        }
        
        // Close mobile sidebar when clicking outside
        document.addEventListener('click', function(event) {
            const data = Alpine.$data(document.querySelector('[x-data]'));
            const mobileModal = document.querySelector('.mobile-sidebar-modal');
            const mobileToggle = document.querySelector('[x-on\\:click*="mobileSidebarOpen = true"]');
            
            if (mobileModal && data.mobileSidebarOpen && 
                !mobileModal.contains(event.target) && 
                event.target !== mobileToggle && 
                !mobileToggle.contains(event.target)) {
                data.mobileSidebarOpen = false;
            }
        });
    });