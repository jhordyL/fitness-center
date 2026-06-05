<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión | Fitness Center</title>

    <style>
        :root {
            --bg-dark: #020617;
            --bg-panel: rgba(15, 23, 42, 0.82);
            --bg-card: rgba(255, 255, 255, 0.96);
            --border-soft: rgba(255, 255, 255, 0.14);
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --danger: #dc2626;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Inter, Arial, Helvetica, sans-serif;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, rgba(79, 70, 229, 0.30), transparent 34%),
                radial-gradient(circle at bottom right, rgba(14, 165, 233, 0.14), transparent 34%),
                linear-gradient(135deg, #020617, #0f172a 48%, #111827);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            color: white;
        }

        .login-shell {
            width: min(960px, 100%);
            min-height: 560px;
            display: grid;
            grid-template-columns: 0.95fr 1.05fr;
            border-radius: 28px;
            overflow: hidden;
            border: 1px solid var(--border-soft);
            background: var(--bg-panel);
            box-shadow: 0 30px 90px rgba(0, 0, 0, 0.38);
            backdrop-filter: blur(18px);
        }

        .brand-side {
            padding: 52px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background:
                linear-gradient(160deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.02)),
                rgba(255, 255, 255, 0.03);
            border-right: 1px solid var(--border-soft);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-mark {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            letter-spacing: -0.5px;
            box-shadow: 0 12px 30px rgba(79, 70, 229, 0.35);
        }

        .brand-name {
            font-size: 22px;
            font-weight: 900;
            letter-spacing: -0.4px;
        }

        .brand-content {
            margin-top: 50px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 13px;
            border-radius: 999px;
            background: rgba(79, 70, 229, 0.16);
            border: 1px solid rgba(129, 140, 248, 0.32);
            color: #c7d2fe;
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 22px;
        }

        .eyebrow-dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: #22c55e;
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.12);
        }

        .brand-content h1 {
            font-size: clamp(36px, 4vw, 52px);
            line-height: 1;
            letter-spacing: -1.8px;
            margin-bottom: 18px;
        }

        .brand-content p {
            color: #cbd5e1;
            font-size: 16px;
            line-height: 1.7;
            max-width: 390px;
        }

        .brand-footer {
            color: #64748b;
            font-size: 13px;
        }

        .form-side {
            background: #f8fafc;
            padding: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-card {
            width: 100%;
            max-width: 410px;
        }

        .form-header {
            margin-bottom: 30px;
        }

        .form-header h2 {
            color: var(--text-dark);
            font-size: 30px;
            line-height: 1.1;
            font-weight: 900;
            letter-spacing: -0.8px;
            margin-bottom: 9px;
        }

        .form-header p {
            color: var(--text-muted);
            font-size: 15px;
            line-height: 1.6;
        }

        .status-message {
            background: #ecfdf5;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 14px;
            margin-bottom: 18px;
        }

        .field {
            margin-bottom: 18px;
        }

        .field label {
            display: block;
            color: #334155;
            font-size: 14px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .field input[type="email"],
        .field input[type="password"] {
            width: 100%;
            height: 48px;
            padding: 0 14px;
            border: 1px solid #cbd5e1;
            border-radius: 13px;
            background: white;
            color: #0f172a;
            font-size: 15px;
            outline: none;
            transition: 0.18s ease;
        }

        .field input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.12);
        }

        .error {
            color: var(--danger);
            font-size: 13px;
            margin-top: 7px;
            line-height: 1.4;
        }

        .options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin: 4px 0 22px;
            flex-wrap: wrap;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #475569;
            font-size: 14px;
            user-select: none;
        }

        .remember input {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
        }

        .forgot-link {
            color: var(--primary);
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .submit-btn {
            width: 100%;
            height: 50px;
            border: none;
            border-radius: 14px;
            background: var(--primary);
            color: white;
            font-weight: 900;
            font-size: 15px;
            cursor: pointer;
            box-shadow: 0 14px 34px rgba(79, 70, 229, 0.28);
            transition: 0.18s ease;
        }

        .submit-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
            text-decoration: none;
            font-weight: 700;
        }

        .back-link:hover {
            color: #334155;
        }

        .access-note {
            margin-top: 20px;
            padding: 13px 14px;
            border-radius: 14px;
            background: #eef2ff;
            color: #3730a3;
            font-size: 13px;
            line-height: 1.5;
        }

        .access-note strong {
            display: block;
            margin-bottom: 2px;
        }

        @media (max-width: 880px) {
            body {
                padding: 18px;
            }

            .login-shell {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .brand-side {
                display: none;
            }

            .form-side {
                padding: 34px 26px;
            }
        }

        @media (max-width: 520px) {
            .form-header h2 {
                font-size: 27px;
            }

            .form-side {
                padding: 30px 22px;
            }
        }
    </style>
</head>

<body>
    <main class="login-shell">
        <section class="brand-side">
            <div class="brand">
                <div class="brand-mark">FC</div>
                <div class="brand-name">Fitness Center</div>
            </div>

            <div class="brand-content">
                <div class="eyebrow">
                    <span class="eyebrow-dot"></span>
                    Sistema operativo en línea
                </div>

                <h1>
                    Acceso interno seguro
                </h1>

                <p>
                    Plataforma para administración de membresías y validación de ingreso mediante código QR.
                </p>
            </div>

            <div class="brand-footer">
                © {{ date('Y') }} Fitness Center · Administración y recepción
            </div>
        </section>

        <section class="form-side">
            <div class="form-card">
                <div class="form-header">
                    <h2>Iniciar sesión</h2>
                    <p>Ingresa con tus credenciales para acceder al sistema.</p>
                </div>

                @if (session('status'))
                    <div class="status-message">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="field">
                        <label for="email">Correo electrónico</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="usuario@fitnesscenter.com"
                        >

                        @if ($errors->get('email'))
                            <div class="error">
                                @foreach ($errors->get('email') as $message)
                                    <div>{{ $message }}</div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="field">
                        <label for="password">Contraseña</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Ingrese su contraseña"
                        >

                        @if ($errors->get('password'))
                            <div class="error">
                                @foreach ($errors->get('password') as $message)
                                    <div>{{ $message }}</div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="options">
                        <label for="remember_me" class="remember">
                            <input id="remember_me" type="checkbox" name="remember">
                            Recuérdame
                        </label>

                        @if (Route::has('password.request'))
                            <a class="forgot-link" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="submit-btn">
                        Ingresar al sistema
                    </button>
                </form>

                <div class="access-note">
                    <strong>Acceso restringido</strong>
                    Solo personal autorizado de administración y recepción.
                </div>

                <a href="{{ url('/') }}" class="back-link">
                    ← Volver a la página principal
                </a>
            </div>
        </section>
    </main>
</body>
</html>
