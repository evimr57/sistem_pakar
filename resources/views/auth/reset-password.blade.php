<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Sistem Pakar Tanaman Kopi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #5FA357 0%, #23753E 100%);
        }

        .container {
            display: flex;
            min-height: 100vh;
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        /* LEFT SIDE - IMAGE */
        .image-section {
            flex: 1;
            background-image: url('/asset/images/jenis-tanaman-kopi-di-indonesia.webp');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .image-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(95, 163, 87, 0.3) 0%, rgba(35, 117, 62, 0.4) 100%);
        }

        .image-content {
            position: relative;
            z-index: 1;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px;
        }

        .image-content h2 {
            color: white;
            font-size: 56px;
            font-weight: 700;
            text-align: center;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
            line-height: 1.2;
        }

        /* RIGHT SIDE - FORM */
        .form-section {
            flex: 1;
            padding: 80px 100px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header h1 {
            font-size: 48px;
            font-weight: 700;
            color: #23753E;
            margin-bottom: 10px;
        }

        .form-header p {
            font-size: 16px;
            color: #666;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s;
            background: #fafafa;
        }

        .form-group input:focus {
            outline: none;
            border-color: #5FA357;
            background: white;
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #999;
            transition: color 0.3s;
            user-select: none;
            width: 20px;
            height: 20px;
        }

        .toggle-password:hover {
            color: #5FA357;
        }

        .toggle-password svg {
            width: 100%;
            height: 100%;
        }

        .submit-btn {
            width: 100%;
            padding: 16px;
            background: #23753E;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background: #5FA357;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(95, 163, 87, 0.4);
        }

        .error-message {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        /* RESPONSIVE */
        @media (max-width: 968px) {
            .container {
                flex-direction: column-reverse;
            }

            .form-section {
                padding: 40px 30px;
            }

            .image-section {
                min-height: 300px;
            }

            .image-content h2 {
                font-size: 36px;
            }

            .form-header h1 {
                font-size: 36px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- LEFT: IMAGE SECTION -->
        <div class="image-section">
            <div class="image-content">
                <h2>SISTEM PAKAR<br>TANAMAN KOPI</h2>
            </div>
        </div>

        <!-- RIGHT: FORM SECTION -->
        <div class="form-section">
            <div class="form-header">
                <h1>RESET PASSWORD</h1>
                <p>Enter your new password below</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                    @error('email')
                        <span class="error-message show">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">New Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" required autocomplete="new-password">
                        <span class="toggle-password" onclick="togglePassword('password')">
                            <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                    </div>
                    @error('password')
                        <span class="error-message show">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                        <span class="toggle-password" onclick="togglePassword('password_confirmation')">
                            <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                    </div>
                    @error('password_confirmation')
                        <span class="error-message show">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">RESET PASSWORD</button>
            </form>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const wrapper = input.parentElement;
            const toggleBtn = wrapper.querySelector('.toggle-password');
            
            if (input.type === 'password') {
                input.type = 'text';
                // Change to eye-slash icon
                toggleBtn.innerHTML = `
                    <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                `;
            } else {
                input.type = 'password';
                // Change back to eye icon
                toggleBtn.innerHTML = `
                    <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                `;
            }
        }
    </script>
</body>
</html>