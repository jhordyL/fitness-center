<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Membresías
            </h2>

            <a href="{{ route('memberships.create') }}"
               style="background-color: #4f46e5; color: white; padding: 8px 14px; border-radius: 6px; text-decoration: none; font-weight: 600;">
                Nueva membresía
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div style="margin-bottom: 16px; padding: 12px 16px; background-color: #dcfce7; color: #166534; border-radius: 6px;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="background: white; border-radius: 10px; padding: 20px; margin-bottom: 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                <form action="{{ route('memberships.index') }}" method="GET" style="display: flex; gap: 10px;">
                    <input type="text"
                           name="search"
                           value="{{ $search }}"
                           placeholder="Buscar por DNI, nombre o apellido"
                           style="flex: 1; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">

                    <button type="submit"
                            style="background-color: #111827; color: white; padding: 10px 16px; border-radius: 6px; border: none; cursor: pointer;">
                        Buscar
                    </button>

                    <a href="{{ route('memberships.index') }}"
                       style="background-color: #6b7280; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none;">
                        Limpiar
                    </a>
                </form>
            </div>

            <div style="background: white; border-radius: 10px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f3f4f6;">
                            <th style="padding: 14px; border: 1px solid #e5e7eb; text-align: left;">ID</th>
                            <th style="padding: 14px; border: 1px solid #e5e7eb; text-align: left;">Cliente</th>
                            <th style="padding: 14px; border: 1px solid #e5e7eb; text-align: left;">Plan</th>
                            <th style="padding: 14px; border: 1px solid #e5e7eb; text-align: left;">Inicio</th>
                            <th style="padding: 14px; border: 1px solid #e5e7eb; text-align: left;">Vencimiento</th>
                            <th style="padding: 14px; border: 1px solid #e5e7eb; text-align: left;">Estado</th>
                            <th style="padding: 14px; border: 1px solid #e5e7eb; text-align: left;">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($memberships as $membership)
                            <tr>
                                <td style="padding: 14px; border: 1px solid #e5e7eb;">{{ $membership->id }}</td>

                                <td style="padding: 14px; border: 1px solid #e5e7eb;">
                                    {{ $membership->client->first_name }} {{ $membership->client->last_name }}
                                    <br>
                                    <small>DNI: {{ $membership->client->dni }}</small>
                                </td>

                                <td style="padding: 14px; border: 1px solid #e5e7eb;">
                                    {{ $membership->plan->name }}
                                </td>

                                <td style="padding: 14px; border: 1px solid #e5e7eb;">
                                    {{ $membership->start_date->format('d/m/Y') }}
                                </td>

                                <td style="padding: 14px; border: 1px solid #e5e7eb;">
                                    {{ $membership->end_date->format('d/m/Y') }}
                                </td>

                                <td style="padding: 14px; border: 1px solid #e5e7eb;">
                                    @if ($membership->status === 'active')
                                        <span style="background-color: #dcfce7; color: #166534; padding: 5px 10px; border-radius: 999px; font-size: 14px; font-weight: 600;">
                                            Activa
                                        </span>
                                    @elseif ($membership->status === 'expired')
                                        <span style="background-color: #fef3c7; color: #92400e; padding: 5px 10px; border-radius: 999px; font-size: 14px; font-weight: 600;">
                                            Vencida
                                        </span>
                                    @else
                                        <span style="background-color: #fee2e2; color: #991b1b; padding: 5px 10px; border-radius: 999px; font-size: 14px; font-weight: 600;">
                                            Cancelada
                                        </span>
                                    @endif
                                </td>

                                <td style="padding: 14px; border: 1px solid #e5e7eb;">
                                    <div style="display: flex; gap: 8px; align-items: center;">
                                        <a href="{{ route('memberships.edit', $membership) }}"
                                           style="background-color: #f59e0b; color: white; padding: 7px 12px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 600;">
                                            Editar
                                        </a>

                                        <form action="{{ route('memberships.destroy', $membership) }}"
                                              method="POST"
                                              onsubmit="return confirm('¿Deseas cambiar el estado de esta membresía?')"
                                              style="margin: 0;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    style="background-color: #374151; color: white; padding: 7px 12px; border-radius: 6px; border: none; cursor: pointer; font-size: 14px; font-weight: 600;">
                                                Cancelar/Activar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7"
                                    style="padding: 16px; border: 1px solid #e5e7eb; text-align: center; color: #6b7280;">
                                    No hay membresías registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
