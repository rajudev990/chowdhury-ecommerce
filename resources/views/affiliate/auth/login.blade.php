@php
$setting = \App\Models\Setting::first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiliate Login</title>
    <link rel="icon" type="image/png" href="{{ $setting->favicon ? Storage::url($setting->favicon) : asset('/assets/img/null.png') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
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
    </style>
</head>

<body class="flex items-center justify-center">

    <div class="rain" id="rain"></div>

    <div class="w-full max-w-md bg-gray-900 rounded-lg shadow-lg p-8">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-white">Affiliate Login</h1>
            <p class="text-gray-400 mt-1">Sign in to start your session</p>
        </div>

        <form method="POST" action="{{ route('affiliate.login.submit') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <div class="flex items-center bg-gray-800 rounded-md overflow-hidden">
                    <span class="px-3 text-gray-400"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" placeholder="Email"
                        class="w-full bg-gray-800 text-white px-3 py-2 focus:outline-none @error('email') border border-red-500 @enderror"
                        value="{{ old('email') }}" autofocus>
                </div>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <div class="flex items-center bg-gray-800 rounded-md overflow-hidden">
                    <span class="px-3 text-gray-400"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" placeholder="Password"
                        class="w-full bg-gray-800 text-white px-3 py-2 focus:outline-none @error('password') border border-red-500 @enderror">
                </div>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember & Button -->
            <div class="flex items-center justify-between mb-4">
                <label class="inline-flex items-center text-gray-400">
                    <input type="checkbox" name="remember" class="form-checkbox h-4 w-4 text-blue-500" {{ old('remember') ? 'checked' : '' }}>
                    <span class="ml-2">Remember Me</span>
                </label>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-semibold">
                    Sign In
                </button>
            </div>
        </form>

    </div>

    <script>
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

        setInterval(() => {
            for (let i = 0; i < 4; i++) {
                createDrop();
            }
        }, 60);
    </script>
</body>

</html>
