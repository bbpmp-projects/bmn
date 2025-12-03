<!DOCTYPE html>
<html>
<head>
    <title>Register Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background: #f5f5f5;
            padding: 20px;
        }
        
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        
        .alert {
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        
        input:focus {
            outline: none;
            border-color: #4a90e2;
        }
        
        .btn {
            width: 100%;
            padding: 12px;
            background: #4a90e2;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        
        .btn:hover {
            background: #357ae8;
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .login-link a {
            color: #4a90e2;
            text-decoration: none;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📝 Register Admin</h2>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        
        <form method="POST" action="{{ route('admin.register.store') }}">
            @csrf
            
            <div class="form-group">
                <label>Nama Lengkap:</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
            </div>
            
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" value="{{ old('username') }}" required>
            </div>
            
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>
            
            <div class="form-group">
                <label>NIP:</label>
                <input type="text" name="nip" value="{{ old('nip') }}" required>
            </div>
            
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label>Konfirmasi Password:</label>
                <input type="password" name="password_confirmation" required>
            </div>
            
            <button type="submit" class="btn">💾 Daftarkan Admin</button>
        </form>
        
        <div class="login-link">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Login disini</a></p>
        </div>
    </div>
</body>
</html>