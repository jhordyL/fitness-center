<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel principal - Fitness Center
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div style="margin-bottom: 24px; background: white; padding: 24px; border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                <h3 style="font-size: 22px; font-weight: 800; margin-bottom: 8px;">
                    Bienvenido, {{ auth()->user()->name }}
                </h3>

                <p style="color: #4b5563;">
                    Rol actual:
                    @if (auth()->user()->role === 'admin')
                        <strong>Administrador</strong>
                    @else
                        <strong>Recepción</strong>
                    @endif
                </p>
            </div>

            @if (auth()->user()->role === 'admin')
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 18px; margin-bottom: 24px;">
                    <div style="background: white; padding: 22px; border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                        <p style="color: #6b7280; margin-bottom: 8px;">Clientes registrados</p>
                        <h3 style="font-size: 30px; font-weight: 800;">{{ $totalClients }}</h3>
                    </div>

                    <div style="background: white; padding: 22px; border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                        <p style="color: #6b7280; margin-bottom: 8px;">Clientes activos</p>
                        <h3 style="font-size: 30px; font-weight: 800;">{{ $activeClients }}</h3>
                    </div>

                    <div style="background: white; padding: 22px; border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                        <p style="color: #6b7280; margin-bottom: 8px;">Membresías vigentes</p>
                        <h3 style="font-size: 30px; font-weight: 800;">{{ $activeMemberships }}</h3>
                    </div>

                    <div style="background: white; padding: 22px; border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                        <p style="color: #6b7280; margin-bottom: 8px;">Planes activos</p>
                        <h3 style="font-size: 30px; font-weight: 800;">{{ $activePlans }}</h3>
                    </div>
                </div>
            @endif

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 24px;">

                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('plans.index') }}"
                       style="background: white; padding: 24px; border-radius: 10px; text-decoration: none; color: #111827; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                        <h3 style="font-size: 20px; font-weight: 800; margin-bottom: 8px;">
                            Planes
                        </h3>
                        <p style="color: #6b7280;">
                            Gestionar planes de membresía, duración, precio y estado.
                        </p>
                    </a>

                    <a href="{{ route('clients.index') }}"
                       style="background: white; padding: 24px; border-radius: 10px; text-decoration: none; color: #111827; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                        <h3 style="font-size: 20px; font-weight: 800; margin-bottom: 8px;">
                            Clientes
                        </h3>
                        <p style="color: #6b7280;">
                            Registrar, editar y consultar clientes del gimnasio.
                        </p>
                    </a>

                    <a href="{{ route('memberships.index') }}"
                       style="background: white; padding: 24px; border-radius: 10px; text-decoration: none; color: #111827; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                        <h3 style="font-size: 20px; font-weight: 800; margin-bottom: 8px;">
                            Membresías
                        </h3>
                        <p style="color: #6b7280;">
                            Asignar membresías, controlar vigencias y estados.
                        </p>
                    </a>
                @endif

                <a href="{{ route('access.scan') }}"
                   style="background: #111827; padding: 24px; border-radius: 10px; text-decoration: none; color: white; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                    <h3 style="font-size: 20px; font-weight: 800; margin-bottom: 8px;">
                        Validar acceso QR
                    </h3>
                    <p style="color: #d1d5db;">
                        Escanear o ingresar manualmente el código QR del cliente.
                    </p>
                </a>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 18px; margin-bottom: 24px;">
                <div style="background: white; padding: 22px; border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                    <p style="color: #6b7280; margin-bottom: 8px;">Validaciones de hoy</p>
                    <h3 style="font-size: 30px; font-weight: 800;">{{ $todayAccesses }}</h3>
                </div>

                <div style="background: white; padding: 22px; border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                    <p style="color: #6b7280; margin-bottom: 8px;">Accesos permitidos hoy</p>
                    <h3 style="font-size: 30px; font-weight: 800; color: #166534;">{{ $allowedToday }}</h3>
                </div>

                <div style="background: white; padding: 22px; border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                    <p style="color: #6b7280; margin-bottom: 8px;">Accesos denegados hoy</p>
                    <h3 style="font-size: 30px; font-weight: 800; color: #991b1b;">{{ $deniedToday }}</h3>
                </div>
            </div>

            <div style="background: white; border-radius: 10px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); overflow-x: auto;">
                <h3 style="font-size: 20px; font-weight: 800; margin-bottom: 16px;">
                    Últimas validaciones de acceso
                </h3>

                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f3f4f6;">
                            <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Fecha</th>
                            <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Cliente</th>
                            <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Resultado</th>
                            <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Motivo</th>
                            <th style="padding: 12px; border: 1px solid #e5e7eb; text-align: left;">Usuario</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($latestAccessLogs as $log)
                            <tr>
                                <td style="padding: 12px; border: 1px solid #e5e7eb;">
                                    {{ $log->created_at->format('d/m/Y H:i') }}
                                </td>

                                <td style="padding: 12px; border: 1px solid #e5e7eb;">
                                    @if ($log->client)
                                        {{ $log->client->first_name }} {{ $log->client->last_name }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td style="padding: 12px; border: 1px solid #e5e7eb;">
                                    @if ($log->result === 'allowed')
                                        <span style="background-color: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 999px; font-weight: 600;">
                                            Permitido
                                        </span>
                                    @else
                                        <span style="background-color: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 999px; font-weight: 600;">
                                            Denegado
                                        </span>
                                    @endif
                                </td>

                                <td style="padding: 12px; border: 1px solid #e5e7eb;">
                                    {{ $log->reason }}
                                </td>

                                <td style="padding: 12px; border: 1px solid #e5e7eb;">
                                    {{ $log->user->name ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    style="padding: 16px; border: 1px solid #e5e7eb; text-align: center; color: #6b7280;">
                                    No hay validaciones registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
