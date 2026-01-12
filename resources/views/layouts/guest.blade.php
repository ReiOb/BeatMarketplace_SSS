<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

        <style>
            body {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Figtree', sans-serif;
            }

            .auth-container {
                width: 100%;
                max-width: 450px;
                padding: 2rem;
            }

            .auth-card {
                background: white;
                border-radius: 1rem;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                padding: 3rem 2rem;
            }

            .auth-header {
                text-align: center;
                margin-bottom: 2rem;
            }

            .auth-header h1 {
                font-size: 1.75rem;
                font-weight: 600;
                color: #1a1a1a;
                margin-bottom: 0.5rem;
            }

            .auth-header p {
                color: #666;
                font-size: 0.95rem;
            }

            .form-label {
                font-weight: 500;
                color: #333;
                margin-bottom: 0.5rem;
            }

            .form-control {
                border: 1px solid #e0e0e0;
                border-radius: 0.5rem;
                padding: 0.75rem 1rem;
                font-size: 0.95rem;
                transition: all 0.3s ease;
            }

            .form-control:focus {
                border-color: #667eea;
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            }

            .btn-auth {
                width: 100%;
                padding: 0.875rem;
                font-weight: 600;
                border-radius: 0.5rem;
                font-size: 0.95rem;
                border: none;
                transition: all 0.3s ease;
            }

            .btn-primary-auth {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }

            .btn-primary-auth:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
                color: white;
            }

            .auth-footer {
                text-align: center;
                margin-top: 1.5rem;
                padding-top: 1.5rem;
                border-top: 1px solid #f0f0f0;
            }

            .auth-footer p {
                color: #666;
                font-size: 0.9rem;
                margin: 0;
            }

            .auth-footer a {
                color: #667eea;
                text-decoration: none;
                font-weight: 600;
            }

            .auth-footer a:hover {
                text-decoration: underline;
            }

            .error-message {
                color: #dc3545;
                font-size: 0.85rem;
                margin-top: 0.35rem;
            }

            .input-group-text {
                background: transparent;
                border: 1px solid #e0e0e0;
                color: #666;
            }
        </style>
    </head>
    <body>
        <div class="auth-container">
            <div class="auth-card">
                {{ $slot }}
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
