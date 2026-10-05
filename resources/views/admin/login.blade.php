<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Masuk Admin - RecruitHub | PT Bachri Samudera Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family:'Plus Jakarta Sans',sans-serif; }
        body { background:#0b1222; }
        .lc { width:100%; max-width:380px; border:0; border-radius:16px; box-shadow:0 20px 50px -20px rgba(0,0,0,.6); }
        .logo { width:44px; height:44px; border-radius:12px; background:#0d6efd; color:#fff; display:flex; align-items:center; justify-content:center; }
        .btn-in { background:#4f46e5; border:0; color:#fff; font-weight:700; padding:.7rem; border-radius:10px; }
        .btn-in:hover { background:#4338ca; color:#fff; }
        .form-control { border-radius:10px; padding:.65rem .9rem; }
    </style>
</head>
<body>
<div class="container d-flex align-items-center justify-content-center" style="min-height:100vh;">
    <div class="card lc">
        <div class="card-body p-4">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="logo"><i class="fa-solid fa-briefcase"></i></div>
                <div>
                    <h1 class="h5 fw-bold mb-0">RecruitHub</h1>
                    <small class="text-muted">Masuk Admin HRD</small>
                </div>
            </div>
            @if(session('error'))<div class="alert alert-danger py-2 small">{{ session('error') }}</div>@endif
            @error('password')<div class="alert alert-danger py-2 small">{{ $message }}</div>@enderror
            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-semibold" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" autofocus required>
                </div>
                <button class="btn btn-in w-100">Masuk</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>