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

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">

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

        </div>
    </div>
</x-app-layout>
