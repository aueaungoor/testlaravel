<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เข้าสู่ระบบ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100" style="background-color: #f8f9fa;">
    @if($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{$message}}</p>
    </div>

    @endif
    <div class="card p-4 shadow-lg" style="width: 350px; border-radius: 15px;">
        <h2 class="text-center mb-4">เข้าสู่ระบบ</h2>
        <form method="POST" action="{{ route('login.login') }}">
            @csrf 
            <div class="mb-3">
                <label class="form-label">Username:</label>
                <input  id="username" type="text" name="username" class="form-control" placeholder="กรอกชื่อผู้ใช้">
                @error('username')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Password:</label>
                <input  id="password" type="password" name="password" class="form-control" placeholder="กรอกรหัสผ่าน">
                @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
            <label for="role">Select Role:</label>
            <select name="role" id="role">
                <option value="chef">Chef</option>
                <option value="shop">Shop</option>
                <option value="user">User</option>
            </select>
            <button type="submit" class="btn btn-primary w-100">เข้าสู่ระบบ</button>
        </form>
    </div>

</body>
</html>
