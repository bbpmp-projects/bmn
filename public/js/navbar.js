// public/js/navbar.js
document.addEventListener('DOMContentLoaded', function() {
    // Logout confirmation
    const logoutForms = document.querySelectorAll('form[action*="logout"]');
    
    logoutForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: 'Apakah Anda yakin ingin logout?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form jika dikonfirmasi
                    this.submit();
                }
            });
        });
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        // Handle feature dropdown
        const featureDropdown = document.getElementById('feature-dropdown');
        if (featureDropdown && !featureDropdown.contains(event.target)) {
            const dropdownMenu = featureDropdown.querySelector('div[class*="opacity-0"]');
            if (dropdownMenu && !dropdownMenu.classList.contains('opacity-0')) {
                dropdownMenu.classList.add('opacity-0', 'invisible');
            }
        }
        
        // Handle profile dropdown
        const profileDropdown = document.getElementById('profile-dropdown');
        if (profileDropdown && !profileDropdown.contains(event.target)) {
            const dropdownMenu = profileDropdown.querySelector('div[class*="opacity-0"]');
            if (dropdownMenu && !dropdownMenu.classList.contains('opacity-0')) {
                dropdownMenu.classList.add('opacity-0', 'invisible');
            }
        }
    });
});