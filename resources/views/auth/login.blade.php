<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin/') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/') }}/dist/css/adminlte.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            background: #0e0e0e;
            overflow: hidden;
            position: relative;
        }

        /* Rain drops */
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

        .login-box{
            margin: auto;
        }
     

    </style>
</head>

<body class="hold-transition">
    <div class="rain" id="rain"></div>
    <div class="login-box pt-5">
        
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <div class="login-logo">
                    <a href="{{ url('/') }}"><b>{{ config('app.name') }}</b></a>
                </div>

                <p class="login-box-msg">Sign in to start your session</p>

                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                    </div>
                    @error('email')
                    <span class="text-danger d-block">{{$message}}</span>
                    @enderror


                    <div class="input-group mt-3 mb-3">
                        <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                    </div>
                    @error('password')
                    <span class="text-danger d-block">{{$message}}</span>
                    @enderror

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('admin/') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/') }}/dist/js/adminlte.min.js"></script>
    <script>
        // Inside your <script> block for rain effect
        const rain = document.getElementById('rain');

        function createDrop() {
            const drop = document.createElement('div');
            drop.classList.add('drop');
            drop.style.left = `${Math.random() * window.innerWidth}px`;
            drop.style.animationDuration = `${0.3 + Math.random() * 0.7}s`;
            drop.style.opacity = 0.2 + Math.random() * 0.5;
            drop.style.height = `${15 + Math.random() * 25}px`;
            rain.appendChild(drop);

            setTimeout(() => {
                drop.remove();
            }, 1500);
        }

        // Increase drop rate
        setInterval(() => {
            for (let i = 0; i < 4; i++) { // 4 drops at a time
                createDrop();
            }
        }, 60);
    </script>
</body>

</html>