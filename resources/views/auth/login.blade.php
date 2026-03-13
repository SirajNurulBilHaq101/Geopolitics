<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - GeoBase</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-200 text-base-content antialiased flex items-center justify-center min-h-screen">

    <div class="card w-96 bg-base-100 shadow-xl border border-base-300">
        <div class="card-body">
            <h2 class="card-title justify-center text-3xl font-bold text-primary mb-6">GeoBase</h2>
            
            <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
                @csrf
                
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" class="input input-bordered @error('email') input-error @enderror" required autofocus>
                    @error('email')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>
                
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" placeholder="••••••••" class="input input-bordered @error('password') input-error @enderror" required>
                    @error('password')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>
                
                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary w-full">Sign In</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
