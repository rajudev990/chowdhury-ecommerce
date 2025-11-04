@php
$setting = \App\Models\Setting::first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiliate Login</title>
    <link rel="icon" type="image/png"
        href="{{ $setting->favicon ? Storage::url($setting->favicon) : asset('/assets/img/null.png') }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            height: 100vh;
            background: #0e0e0e;
            overflow: hidden;
            position: relative;
        }

        .rain {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            top: 0;
            left: 0;
            z-index: -1;
        }

        .drop {
            position: absolute;
            width: 2px;
            background: rgba(255, 255, 255, 0.3);
            bottom: 100%;
            animation: fall linear infinite;
            border-radius: 50%;
        }

        @keyframes fall {
            to {
                transform: translateY(100vh);
            }
        }

        .login-card {
            background: #111;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
        }

        .form-control {
            background-color: #222;
            color: #fff;
            border: none;
        }

        .form-control:focus {
            background-color: #222;
            color: #fff;
            box-shadow: none;
            border: 1px solid #0d6efd;
        }

        .input-group-text {
            background-color: #222;
            color: #999;
            border: none;
        }

        .text-muted {
            color: #aaa !important;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">

    <div class="rain" id="rain"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="login-card p-4">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-white">Login</h2>
                        <p class="text-muted mb-0">Sign in to start your session</p>
                    </div>

                    <form method="POST" action="{{ route('affiliate.login.submit') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                    autofocus>
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" id="passwordField"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password">
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword"
                                    style="border: none;">
                                    <i class="fa fa-eye text-light"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember & Button -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check text-muted">
                                <input class="form-check-input" type="checkbox" name="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label">Remember Me</label>
                            </div>
                            <button type="submit" class="btn btn-primary px-4">Sign In</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Password toggle -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('passwordField');
            const icon = this.querySelector('i');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Rain effect
        const rain = document.getElementById('rain');

        function createDrop() {
            const drop = document.createElement('div');
            drop.classList.add('drop');
            drop.style.left = `${Math.random() * window.innerWidth}px`;
            drop.style.animationDuration = `${0.3 + Math.random() * 0.7}s`;
            drop.style.opacity = 0.2 + Math.random() * 0.5;
            drop.style.height = `${15 + Math.random() * 25}px`;
            rain.appendChild(drop);
            setTimeout(() => drop.remove(), 1500);
        }

        setInterval(() => {
            for (let i = 0; i < 4; i++) createDrop();
        }, 60);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>