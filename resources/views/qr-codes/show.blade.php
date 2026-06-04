<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Código QR del cliente
            </h2>

            <a href="{{ route('clients.index') }}"
               style="background-color: #6b7280; color: white; padding: 8px 14px; border-radius: 6px; text-decoration: none; font-weight: 600;">
                Volver a clientes
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div style="margin-bottom: 16px; padding: 12px 16px; background-color: #dcfce7; color: #166534; border-radius: 6px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background: white; border-radius: 10px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 12px;">
                    {{ $client->first_name }} {{ $client->last_name }}
                </h3>

                <p style="margin-bottom: 6px;">
                    <strong>DNI:</strong> {{ $client->dni }}
                </p>

                <p style="margin-bottom: 20px;">
                    <strong>Estado del cliente:</strong>
                    @if ($client->status === 'active')
                        <span style="background-color: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 999px; font-weight: 600;">
                            Activo
                        </span>
                    @else
                        <span style="background-color: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 999px; font-weight: 600;">
                            Inactivo
                        </span>
                    @endif
                </p>

                @if ($qrCode)
                    <div style="display: flex; gap: 30px; align-items: center; flex-wrap: wrap;">
                        <div style="padding: 18px; border: 1px solid #e5e7eb; border-radius: 10px; background-color: #f9fafb;">
                            {!! QrCode::size(220)->generate($qrCode->code) !!}
                        </div>

                        <div>
                            <p style="margin-bottom: 8px;">
                                <strong>Código interno:</strong>
                            </p>

                            <div style="background-color: #f3f4f6; padding: 12px; border-radius: 6px; margin-bottom: 14px; font-family: monospace;">
                                {{ $qrCode->code }}
                            </div>

                            <p style="margin-bottom: 14px;">
                                <strong>Estado del QR:</strong>
                                @if ($qrCode->status === 'active')
                                    <span style="background-color: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 999px; font-weight: 600;">
                                        Activo
                                    </span>
                                @else
                                    <span style="background-color: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 999px; font-weight: 600;">
                                        Inactivo
                                    </span>
                                @endif
                            </p>

                            <form action="{{ route('clients.qr.regenerate', $client) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Deseas regenerar el QR? El código anterior dejará de ser válido.')">
                                @csrf

                                <button type="submit"
                                        style="background-color: #dc2626; color: white; padding: 9px 14px; border-radius: 6px; border: none; cursor: pointer; font-weight: 600;">
                                    Regenerar QR
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div style="padding: 16px; background-color: #fef3c7; color: #92400e; border-radius: 6px; margin-bottom: 16px;">
                        Este cliente todavía no tiene un código QR generado.
                    </div>

                    <form action="{{ route('clients.qr.generate', $client) }}" method="POST">
                        @csrf

                        <button type="submit"
                                style="background-color: #4f46e5; color: white; padding: 9px 14px; border-radius: 6px; border: none; cursor: pointer; font-weight: 600;">
                            Generar QR
                        </button>
                    </form>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
