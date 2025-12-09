        document.addEventListener('alpine:init', () => {
            // Handle responsive sidebar
            const checkScreenSize = () => {
                const data = Alpine.$data(document.querySelector('[x-data]'));
                if (window.innerWidth < 1024 && data.sidebarOpen) {
                    data.sidebarOpen = false;
                }
            };
            
            window.addEventListener('resize', checkScreenSize);
            checkScreenSize();
            
            // Close mobile sidebar when clicking outside
            document.addEventListener('click', function(event) {
                const data = Alpine.$data(document.querySelector('[x-data]'));
                const sidebar = document.querySelector('aside');
                const mobileToggle = document.querySelector('[x-on\\:click*="sidebarOpen = !sidebarOpen"]');
                
                if (window.innerWidth < 1024 && 
                    data.sidebarOpen && 
                    !sidebar.contains(event.target) && 
                    event.target !== mobileToggle && 
                    !mobileToggle.contains(event.target)) {
                    data.sidebarOpen = false;
                }
            });
            
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
        });
        
        // Hide elements before Alpine initializes
        [].slice.call(document.querySelectorAll('[x-cloak]')).forEach(function (el) {
            el.style.display = 'none';
        });