document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.getElementById('toggle-password');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');

    const togglePasswordConfirmation = document.getElementById('toggle-password-confirmation');
    const passwordConfirmationInput = document.getElementById('password_confirmation');
    const eyeIconConfirmation = document.getElementById('eye-icon-confirmation');

    function setupPasswordToggle(button, input, icon) {
        button.addEventListener('click', function() {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            // Toggle eye icon
            if (type === 'text') {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    }

    setupPasswordToggle(togglePassword, passwordInput, eyeIcon);
    setupPasswordToggle(togglePasswordConfirmation, passwordConfirmationInput, eyeIconConfirmation);

    // Real-time password validation
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('password_confirmation');

    function validatePassword() {
        const password = passwordField.value;
        const confirmPassword = confirmPasswordField.value;
        
        if (confirmPassword && password !== confirmPassword) {
            confirmPasswordField.classList.add('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
            confirmPasswordField.classList.remove('border-gray-300', 'focus:ring-blue-500', 'focus:border-blue-500');
        } else {
            confirmPasswordField.classList.remove('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
            confirmPasswordField.classList.add('border-gray-300', 'focus:ring-blue-500', 'focus:border-blue-500');
        }
        
        if (password.length > 0 && password.length < 8) {
            passwordField.classList.add('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
            passwordField.classList.remove('border-gray-300', 'focus:ring-blue-500', 'focus:border-blue-500');
        } else {
            passwordField.classList.remove('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
            passwordField.classList.add('border-gray-300', 'focus:ring-blue-500', 'focus:border-blue-500');
        }
    }

    passwordField.addEventListener('input', validatePassword);
    confirmPasswordField.addEventListener('input', validatePassword);

    // Form validation sebelum submit (untuk SweetAlert2)
    const form = document.getElementById('registerForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const loadingSpinner = document.getElementById('loadingSpinner');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const terms = document.querySelector('input[name="terms"]').checked;
            
            // Validasi client-side dengan SweetAlert2
            let isValid = true;
            let errorMessage = '';
            
            // Validasi password match
            if (password !== confirmPassword) {
                isValid = false;
                errorMessage = 'Password dan konfirmasi password tidak sama!';
            }
            
            // Validasi password length
            if (password.length < 8) {
                isValid = false;
                errorMessage = 'Password harus minimal 8 karakter!';
            }
            
            // Validasi terms
            if (!terms) {
                isValid = false;
                errorMessage = 'Anda harus menyetujui syarat dan ketentuan!';
            }
            
            if (!isValid) {
                // Show SweetAlert2 error
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    text: errorMessage,
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'OK'
                });
                return false;
            }
            
            // Jika valid, submit via AJAX
            submitFormViaAjax(form);
        });
    }

    // Fungsi untuk submit form via AJAX
    async function submitFormViaAjax(form) {
        // Show loading state
        submitBtn.disabled = true;
        submitText.classList.add('hidden');
        loadingSpinner.classList.remove('hidden');
        
        try {
            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                // Success popup
                await Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    confirmButtonColor: '#3b82f6',
                    confirmButtonText: 'OK',
                    timer: 3000,
                    timerProgressBar: true
                });
                
                // Reset form
                form.reset();
                
                // Redirect ke login page
                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            } else {
                // Error popup
                let errorMessage = data.message;
                if (data.errors) {
                    const errorList = Object.values(data.errors).flat().join('<br>');
                    errorMessage = errorList;
                }
                
                await Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    html: errorMessage,
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'Coba Lagi'
                });
            }
        } catch (error) {
            // Network error
            await Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan jaringan. Silakan coba lagi.',
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'OK'
            });
        } finally {
            // Reset button state
            submitBtn.disabled = false;
            submitText.classList.remove('hidden');
            loadingSpinner.classList.add('hidden');
        }
    }

    // Real-time NIP validation (hanya angka)
    const nipField = document.getElementById('nip');
    if (nipField) {
        nipField.addEventListener('input', function() {
            // Hanya allow angka
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    }

    // Username validation (hanya alphanumeric dan underscore)
    const usernameField = document.getElementById('username');
    if (usernameField) {
        usernameField.addEventListener('input', function() {
            // Hanya allow alphanumeric dan underscore
            this.value = this.value.replace(/[^a-zA-Z0-9_]/g, '');
        });
    }

    // Tambahkan real-time feedback untuk terms checkbox
    const termsCheckbox = document.querySelector('input[name="terms"]');
    if (termsCheckbox) {
        termsCheckbox.addEventListener('change', function() {
            if (this.checked) {
                this.parentElement.classList.remove('text-red-600');
                this.parentElement.classList.add('text-gray-600');
            } else {
                this.parentElement.classList.add('text-red-600');
                this.parentElement.classList.remove('text-gray-600');
            }
        });
    }

    // Unit kerja auto-uppercase untuk kata pertama setiap kata
    const unitKerjaField = document.getElementById('unit_kerja');
    if (unitKerjaField) {
        unitKerjaField.addEventListener('blur', function() {
            if (this.value.trim()) {
                // Capitalize first letter of each word
                this.value = this.value.toLowerCase().replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                });
            }
        });
    }

    // Email validation real-time
    const emailField = document.getElementById('email');
    if (emailField) {
        emailField.addEventListener('blur', function() {
            const email = this.value.trim();
            if (email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    this.classList.add('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
                    this.classList.remove('border-gray-300', 'focus:ring-blue-500', 'focus:border-blue-500');
                } else {
                    this.classList.remove('border-red-500', 'focus:ring-red-500', 'focus:border-red-500');
                    this.classList.add('border-gray-300', 'focus:ring-blue-500', 'focus:border-blue-500');
                }
            }
        });
    }

    // Nama lengkap auto-capitalize
    const namaLengkapField = document.getElementById('nama_lengkap');
    if (namaLengkapField) {
        namaLengkapField.addEventListener('blur', function() {
            if (this.value.trim()) {
                // Capitalize first letter of each word
                this.value = this.value.toLowerCase().replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                });
            }
        });
    }
});