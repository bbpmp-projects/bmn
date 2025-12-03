document.addEventListener('DOMContentLoaded', function() {
    console.log('Profile.js loaded');
    
    // CSRF Token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    // Section Management
    const sections = {
        'profile-info': document.getElementById('profile-info-section'),
        'change-password': document.getElementById('change-password-section'),
        'profile-initial': document.getElementById('profile-initial-section')
    };
    
    // Show specific section
    window.showSection = function(sectionId) {
        // Hide all sections
        Object.values(sections).forEach(section => {
            if (section) section.classList.add('hidden');
        });
        
        // Show selected section
        if (sections[sectionId]) {
            sections[sectionId].classList.remove('hidden');
        }
    };
    
    // Default show profile info
    showSection('profile-info');
    
    // === Profile Form Submission ===
    const profileForm = document.getElementById('profile-form');
    if (profileForm) {
        // Get URL from data attribute
        const updateProfileUrl = profileForm.getAttribute('data-update-url');
        console.log('Profile Update URL:', updateProfileUrl);
        
        profileForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('update-profile-btn');
            const submitText = document.getElementById('submit-text');
            const loadingSpinner = document.getElementById('loading-spinner');
            
            // Clear previous errors
            document.querySelectorAll('[class^="error-"]').forEach(el => {
                el.textContent = '';
            });
            
            // Show loading
            submitBtn.disabled = true;
            submitText.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');
            
            try {
                const formData = new FormData(this);
                console.log('Updating profile...');
                
                const response = await fetch(updateProfileUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                });
                
                console.log('Profile update response status:', response.status);
                
                // Check if response is JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    const textResponse = await response.text();
                    console.error('Response bukan JSON:', textResponse);
                    throw new Error('Response bukan JSON. Server error mungkin.');
                }
                
                const data = await response.json();
                console.log('Profile update response:', data);
                
                if (data.success === true) {
                    // Update initial in the card
                    const initialCard = document.querySelector('.bg-gradient-to-r.from-purple-500.to-pink-500.text-white');
                    if (initialCard && data.initial) {
                        initialCard.textContent = data.initial;
                    }
                    
                    // Update initial in the initial section
                    const initialSection = document.querySelector('#profile-initial-section .bg-gradient-to-r.from-purple-500.to-pink-500.text-3xl');
                    if (initialSection && data.initial) {
                        initialSection.textContent = data.initial;
                    }
                    
                    // Update user info in initial section
                    const userNameElement = document.querySelector('#profile-initial-section .text-lg.font-semibold');
                    if (userNameElement && data.nama_lengkap) {
                        userNameElement.textContent = data.nama_lengkap;
                    }
                    
                    // Update nama lengkap text under initial card
                    const namaLengkapText = document.querySelector('.text-xs.text-purple-600.font-medium');
                    if (namaLengkapText && data.nama_lengkap) {
                        namaLengkapText.textContent = data.nama_lengkap;
                    }
                    
                    await Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        confirmButtonColor: '#3b82f6',
                        confirmButtonText: 'OK'
                    });
                } else {
                    // Show validation errors
                    if (data.errors) {
                        console.log('Validation errors:', data.errors);
                        Object.keys(data.errors).forEach(key => {
                            const errorElement = document.querySelector(`.error-${key}`);
                            if (errorElement) {
                                errorElement.textContent = data.errors[key][0];
                            }
                        });
                        
                        // Show error message
                        let errorMessage = data.message || 'Validasi gagal';
                        if (data.errors) {
                            const errorList = Object.values(data.errors).flat().join('<br>');
                            errorMessage = errorList;
                        }
                        
                        await Swal.fire({
                            icon: 'error',
                            title: 'Validasi Gagal!',
                            html: errorMessage,
                            confirmButtonColor: '#ef4444',
                            confirmButtonText: 'Perbaiki'
                        });
                    } else {
                        await Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message || 'Terjadi kesalahan',
                            confirmButtonColor: '#ef4444',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            } catch (error) {
                console.error('Profile update error:', error);
                console.error('Error stack:', error.stack);
                
                await Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan: ' + error.message,
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'OK'
                });
            } finally {
                // Reset button state
                submitBtn.disabled = false;
                submitText.classList.remove('hidden');
                loadingSpinner.classList.add('hidden');
            }
        });
    }
    
    // === Password Form Submission ===
    const passwordForm = document.getElementById('password-form');
    if (passwordForm) {
        // Get URL from data attribute
        const updatePasswordUrl = passwordForm.getAttribute('data-update-url');
        console.log('Password Update URL:', updatePasswordUrl);
        
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
        
        passwordForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('update-password-btn');
            const submitText = document.getElementById('password-submit-text');
            const loadingSpinner = document.getElementById('password-loading-spinner');
            
            // Clear previous errors
            document.querySelectorAll('[class^="error-"]').forEach(el => {
                el.textContent = '';
            });
            
            // Show loading
            submitBtn.disabled = true;
            submitText.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');
            
            try {
                const formData = new FormData(this);
                console.log('Updating password...');
                
                const response = await fetch(updatePasswordUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                });
                
                console.log('Password update response status:', response.status);
                
                // Check if response is JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    const textResponse = await response.text();
                    console.error('Response bukan JSON:', textResponse);
                    throw new Error('Response bukan JSON. Server error mungkin.');
                }
                
                const data = await response.json();
                console.log('Password update response:', data);
                
                if (data.success === true) {
                    await Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        confirmButtonColor: '#10b981',
                        confirmButtonText: 'OK'
                    });
                    
                    // Clear form
                    passwordForm.reset();
                } else {
                    // Show validation errors
                    if (data.errors) {
                        console.log('Validation errors:', data.errors);
                        Object.keys(data.errors).forEach(key => {
                            const errorElement = document.querySelector(`.error-${key}`);
                            if (errorElement) {
                                errorElement.textContent = data.errors[key][0];
                            }
                        });
                        
                        // Show error message
                        let errorMessage = data.message || 'Validasi gagal';
                        if (data.errors) {
                            const errorList = Object.values(data.errors).flat().join('<br>');
                            errorMessage = errorList;
                        }
                        
                        await Swal.fire({
                            icon: 'error',
                            title: 'Validasi Gagal!',
                            html: errorMessage,
                            confirmButtonColor: '#ef4444',
                            confirmButtonText: 'Perbaiki'
                        });
                    } else {
                        await Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message || 'Terjadi kesalahan',
                            confirmButtonColor: '#ef4444',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            } catch (error) {
                console.error('Password update error:', error);
                console.error('Error stack:', error.stack);
                
                await Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan: ' + error.message,
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'OK'
                });
            } finally {
                // Reset button state
                submitBtn.disabled = false;
                submitText.classList.remove('hidden');
                loadingSpinner.classList.add('hidden');
            }
        });
    }
});