// public/js/login.js

document.addEventListener('DOMContentLoaded', function() {
    console.log('Login.js loaded');
    
    // Ambil CSRF token dari meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    console.log('CSRF Token:', csrfToken);
    
    // Dapatkan action URL dari form (jika ada) atau gunakan path default
    const loginForm = document.getElementById('loginForm');
    const loginUrl = loginForm?.getAttribute('action') || '/login';
    console.log('Login URL:', loginUrl);
    
    // Toggle Password Visibility
    const togglePassword = document.getElementById('toggle-password');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');

    if (togglePassword && passwordInput && eyeIcon) {
        togglePassword.addEventListener('click', function() {
            // Toggle password visibility
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle eye icon
            if (type === 'password') {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        });
    }

    // Form submission handler
    if (loginForm) {
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const loadingSpinner = document.getElementById('loadingSpinner');
        const loginField = document.getElementById('login');
        const passwordField = document.getElementById('password');
        
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            console.log('Form submitted');
            console.log('Login value:', loginField?.value);
            console.log('Password length:', passwordField?.value?.length);
            
            // Validasi sederhana
            let isValid = true;
            if (loginField && loginField.value.trim() === '') {
                loginField.classList.add('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
                isValid = false;
            }
            if (passwordField && passwordField.value.trim() === '') {
                passwordField.classList.add('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
                isValid = false;
            }
            
            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Harap isi semua field yang diperlukan.',
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'OK'
                });
                return;
            }
            
            // Show loading state
            if (submitBtn && submitText && loadingSpinner) {
                submitBtn.disabled = true;
                submitText.classList.add('hidden');
                loadingSpinner.classList.remove('hidden');
            }
            
            try {
                const formData = new FormData(this);
                console.log('Sending request to:', loginUrl);
                
                const response = await fetch(loginUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken || '',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                });
                
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                
                // Cek apakah response valid JSON
                const contentType = response.headers.get('content-type');
                console.log('Content-Type:', contentType);
                
                if (!contentType || !contentType.includes('application/json')) {
                    const textResponse = await response.text();
                    console.error('Response bukan JSON:', textResponse);
                    throw new Error('Response bukan JSON. Server mungkin mengembalikan HTML atau error.');
                }
                
                const data = await response.json();
                console.log('Response data:', data);
                console.log('Success status:', data.success);
                
                // Cek success dengan type checking yang lebih ketat
                if (data.success === true || data.success === 'true' || response.status === 200 && data.redirect) {
                    console.log('Login SUCCESS - redirecting to:', data.redirect);
                    
                    // LANGSUNG REDIRECT tanpa alert
                    const redirectUrl = data.redirect || '/';
                    console.log('Immediate redirect to:', redirectUrl);
                    window.location.replace(redirectUrl); // Gunakan replace agar tidak bisa back
                    return; // Stop eksekusi kode selanjutnya
                    
                } else {
                    console.log('Login FAILED:', data.message);
                    
                    // Error popup
                    let errorMessage = data.message || 'Terjadi kesalahan';
                    if (data.errors) {
                        const errorList = Object.values(data.errors).flat().join('<br>');
                        errorMessage = errorList;
                    }
                    
                    await Swal.fire({
                        icon: 'error',
                        title: 'Gagal Login!',
                        html: errorMessage,
                        confirmButtonColor: '#ef4444',
                        confirmButtonText: 'Coba Lagi'
                    });
                    
                    // Reset button state untuk error
                    if (submitBtn && submitText && loadingSpinner) {
                        submitBtn.disabled = false;
                        submitText.classList.remove('hidden');
                        loadingSpinner.classList.add('hidden');
                    }
                }
            } catch (error) {
                console.error('Login error:', error);
                console.error('Error stack:', error.stack);
                
                await Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan: ' + error.message,
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'OK'
                });
                
                // Reset button state untuk error
                if (submitBtn && submitText && loadingSpinner) {
                    submitBtn.disabled = false;
                    submitText.classList.remove('hidden');
                    loadingSpinner.classList.add('hidden');
                }
            }
        });
    }

    // Di akhir file login.js, tambahkan:
        document.addEventListener('DOMContentLoaded', function() {
            // Cek jika ada auth alert dari session
            const authAlert = document.getElementById('auth-alert-data');
            if (authAlert) {
                const alertData = JSON.parse(authAlert.textContent);
                Swal.fire({
                    icon: alertData.type || 'warning',
                    title: alertData.title || 'Perhatian',
                    text: alertData.message || 'Anda harus login terlebih dahulu.',
                    confirmButtonColor: '#3b82f6',
                    confirmButtonText: 'OK'
                });
            }
        });

    // Real-time validation untuk form
    const loginField = document.getElementById('login');
    const passwordField = document.getElementById('password');

    if (loginField) {
        loginField.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.classList.remove('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
                this.classList.add('border-gray-300', 'focus:ring-blue-500', 'focus:border-blue-500');
            }
        });
    }

    if (passwordField) {
        passwordField.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.classList.remove('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
                this.classList.add('border-gray-300', 'focus:ring-blue-500', 'focus:border-blue-500');
            }
        });
    }

    // Enter key untuk submit
    if (loginField) {
        loginField.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                if (passwordField) passwordField.focus();
            }
        });
    }

    if (passwordField) {
        passwordField.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                if (loginForm) loginForm.dispatchEvent(new Event('submit'));
            }
        });
    }

    // Auto-focus pada login field saat page load
    if (loginField) {
        setTimeout(() => {
            loginField.focus();
        }, 300);
    }

    // Forgot password link handler
    const forgotPasswordLink = document.querySelector('a[href="#"]');
    if (forgotPasswordLink && forgotPasswordLink.textContent.includes('Lupa Password')) {
        forgotPasswordLink.addEventListener('click', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Lupa Password?',
                html: `
                    <p class="text-gray-600 mb-4">Masukkan email Anda untuk reset password:</p>
                    <input type="email" id="forgot-email" class="swal2-input" placeholder="Email Anda">
                `,
                showCancelButton: true,
                confirmButtonText: 'Kirim Link Reset',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#3b82f6',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    const email = document.getElementById('forgot-email').value;
                    if (!email || !/^\S+@\S+\.\S+$/.test(email)) {
                        Swal.showValidationMessage('Masukkan email yang valid');
                        return false;
                    }
                    
                    return fetch('/forgot-password', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken || '',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ email: email })
                    })
                    .then(response => response.json())
                    .catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Email Terkirim!',
                        'Link reset password telah dikirim ke email Anda.',
                        'success'
                    );
                }
            });
        });
    }
});