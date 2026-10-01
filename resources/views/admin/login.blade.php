<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Masuk Admin - PT Bachri Samudera Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#0b131e;">
<div class="container d-flex align-items-center justify-content-center" style="min-height:100vh;">
    <div class="card shadow" style="width:100%;max-width:380px;">
        <div class="card-body p-4">
            <h1 class="h5 fw-bold mb-3">Masuk Admin</h1>
            @if(session('error'))<div class="alert alert-danger py-2">{{ session('error') }}</div>@endif
            @error('password')<div class="alert alert-danger py-2">{{ $message }}</div>@enderror
            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" autofocus required>
                </div>
                <button class="btn btn-warning w-100 fw-bold">Masuk</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>