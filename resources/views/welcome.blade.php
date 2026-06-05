<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fitness Center | Sistema de Membresías</title>

    <style>
        :root {
            --bg-main: #0f172a;
            --bg-card: rgba(255, 255, 255, 0.08);
            --border-soft: rgba(255, 255, 255, 0.14);
            --text-main: #ffffff;
            --text-muted: #cbd5e1;
            --primary: #4f46e5;
            --primary-hover: #4338ca;
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
                radial-gradient(circle at top left, rgba(79, 70, 229, 0.32), transparent 35%),
                radial-gradient(circle at bottom right, rgba(14, 165, 233, 0.16), transparent 35%),
                linear-gradient(135deg, #020617, #0f172a 45%, #111827);
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px;
        }

        .splash {
            width: min(1040px, 100%);
            min-height: 620px;
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            border: 1px solid var(--border-soft);
            border-radius: 28px;
            overflow: hidden;
            background: rgba(15, 23, 42, 0.72);
            box-shadow: 0 30px 90px rgba(0, 0, 0, 0.38);
            backdrop-filter: blur(18px);
        }

        .content {
            padding: 58px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
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

        .hero {
            max-width: 560px;
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
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.12);
        }

        h1 {
            font-size: clamp(42px, 5vw, 68px);
            line-height: 0.98;
            letter-spacing: -2.4px;
            margin-bottom: 22px;
        }

        .description {
            color: var(--text-muted);
            font-size: 18px;
            line-height: 1.7;
            max-width: 520px;
            margin-bottom: 34px;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 0 22px;
            border-radius: 13px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            font-weight: 900;
            box-shadow: 0 14px 34px rgba(79, 70, 229, 0.34);
            transition: 0.2s ease;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        .note {
            color: #94a3b8;
            font-size: 13px;
            margin-top: 16px;
        }

        .footer {
            color: #64748b;
            font-size: 13px;
        }

        .visual {
            position: relative;
            padding: 42px;
            background:
                linear-gradient(160deg, rgba(255, 255, 255, 0.09), rgba(255, 255, 255, 0.025)),
                rgba(255, 255, 255, 0.04);
            border-left: 1px solid var(--border-soft);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .phone-card {
            width: min(340px, 100%);
            border-radius: 28px;
            padding: 24px;
            background: rgba(2, 6, 23, 0.66);
            border: 1px solid rgba(255, 255, 255, 0.16);
            box-shadow: 0 24px 70px rgba(0,0,0,0.32);
        }

        .phone-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .phone-title {
            font-size: 15px;
            font-weight: 900;
        }

        .status {
            padding: 5px 10px;
            border-radius: 999px;
            background: rgba(34, 197, 94, 0.12);
            color: #86efac;
            font-size: 12px;
            font-weight: 800;
        }

        .qr-box {
            height: 210px;
            border-radius: 22px;
            background: white;
            display: grid;
            place-items: center;
            margin-bottom: 22px;
        }

        .qr-grid {
            width: 128px;
            height: 128px;
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            grid-template-rows: repeat(7, 1fr);
            gap: 5px;
        }

        .qr-grid span {
            background: #0f172a;
            border-radius: 3px;
        }

        .qr-grid span:nth-child(2),
        .qr-grid span:nth-child(5),
        .qr-grid span:nth-child(8),
        .qr-grid span:nth-child(10),
        .qr-grid span:nth-child(13),
        .qr-grid span:nth-child(16),
        .qr-grid span:nth-child(18),
        .qr-grid span:nth-child(22),
        .qr-grid span:nth-child(24),
        .qr-grid span:nth-child(27),
        .qr-grid span:nth-child(30),
        .qr-grid span:nth-child(32),
        .qr-grid span:nth-child(35),
        .qr-grid span:nth-child(38),
        .qr-grid span:nth-child(40),
        .qr-grid span:nth-child(43),
        .qr-grid span:nth-child(45),
        .qr-grid span:nth-child(49) {
            background: transparent;
        }

        .access-result {
            padding: 16px;
            border-radius: 18px;
            background: rgba(34, 197, 94, 0.12);
            border: 1px solid rgba(34, 197, 94, 0.22);
        }

        .access-result strong {
            display: block;
            color: #86efac;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .access-result span {
            color: #cbd5e1;
            font-size: 13px;
        }

        .floating {
            position: absolute;
            border-radius: 18px;
            background: var(--bg-card);
            border: 1px solid var(--border-soft);
            padding: 14px 16px;
            color: #e5e7eb;
            font-size: 13px;
            box-shadow: 0 16px 40px rgba(0,0,0,0.24);
        }

        .floating.one {
            top: 78px;
            left: 38px;
        }

        .floating.two {
            bottom: 80px;
            right: 38px;
        }

        .floating strong {
            display: block;
            font-size: 18px;
            color: white;
            margin-bottom: 2px;
        }

        @media (max-width: 900px) {
            body {
                padding: 18px;
            }

            .splash {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .content {
                padding: 34px;
                gap: 58px;
            }

            .visual {
                display: none;
            }

            h1 {
                font-size: 44px;
            }

            .description {
                font-size: 16px;
            }
        }

        @media (max-width: 520px) {
            .content {
                padding: 28px;
            }

            .brand-name {
                font-size: 19px;
            }

            h1 {
                font-size: 38px;
                letter-spacing: -1.4px;
            }

            .btn-primary {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <main class="splash">
        <section class="content">
            <div class="brand">
                <div class="brand-mark">FC</div>
                <div class="brand-name">Fitness Center</div>
            </div>

            <div class="hero">
                <div class="eyebrow">
                    <span class="eyebrow-dot"></span>
                    Sistema operativo en línea
                </div>

                <h1>
                    Control de membresías y acceso QR
                </h1>

                <p class="description">
                    Plataforma interna para administrar membresías activas y validar el ingreso de usuarios mediante código QR.
                </p>

                <div class="actions">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">
                            Entrar al panel
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary">
                            Iniciar sesión
                        </a>
                    @endauth
                </div>

                <p class="note">
                    Acceso exclusivo para administración y recepción.
                </p>
            </div>

            <div class="footer">
                © {{ date('Y') }} Fitness Center · Sistema web de gestión
            </div>
        </section>

        <section class="visual" aria-hidden="true">
            <div class="floating one">
                <strong>QR</strong>
                Validación rápida
            </div>

            <div class="phone-card">
                <div class="phone-top">
                    <div class="phone-title">Acceso de cliente</div>
                    <div class="status">Activo</div>
                </div>

                <div class="qr-box">
                    <div class="qr-grid">
                        @for ($i = 0; $i < 49; $i++)
                            <span></span>
                        @endfor
                    </div>
                </div>

                <div class="access-result">
                    <strong>Acceso permitido</strong>
                    <span>Membresía vigente validada correctamente.</span>
                </div>
            </div>

            <div class="floating two">
                <strong>24/7</strong>
                Disponible desde la web
            </div>
        </section>
    </main>
</body>
</html>
