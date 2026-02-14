<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Sistem Pakar Tanaman Kopi</title>
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

        .form-footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }

        .form-footer a {
            color: #5FA357;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .form-footer a:hover {
            color: #23753E;
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

        .session-status {
            background: #C1FA70;
            color: #23753E;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: 14px;
            font-weight: 600;
        }

        .info-box {
            background: #f0f9ff;
            border-left: 4px solid #5FA357;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .info-box p {
            font-size: 14px;
            color: #555;
            line-height: 1.6;
            margin: 0;
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
                <h1>FORGOT PASSWORD</h1>
                <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="session-status">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="error-message show">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">EMAIL PASSWORD RESET LINK</button>

                <!-- Back to Login -->
                <div class="form-footer">
                    Remember your password? <a href="{{ route('login') }}">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>