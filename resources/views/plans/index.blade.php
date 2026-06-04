<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Planes de membresía
            </h2>

            <a href="{{ route('plans.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                Nuevo plan
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="p-3 border">ID</th>
                                <th class="p-3 border">Nombre</th>
                                <th class="p-3 border">Duración</th>
                                <th class="p-3 border">Precio</th>
                                <th class="p-3 border">Estado</th>
                                <th class="p-3 border">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($plans as $plan)
                                <tr>
                                    <td class="p-3 border">{{ $plan->id }}</td>
                                    <td class="p-3 border">{{ $plan->name }}</td>
                                    <td class="p-3 border">{{ $plan->duration_days }} días</td>
                                    <td class="p-3 border">S/ {{ number_format($plan->price, 2) }}</td>
                                    <td class="p-3 border">
                                        @if ($plan->status === 'active')
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded">
                                                Activo
                                            </span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded">
                                                Inactivo
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-3 border">
                                        <div class="flex gap-2">
                                            <a href="{{ route('plans.edit', $plan) }}"
                                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                                Editar
                                            </a>

                                            <form action="{{ route('plans.destroy', $plan) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('¿Deseas cambiar el estado de este plan?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="px-3 py-1 bg-gray-700 text-white rounded hover:bg-gray-800">
                                                    Cambiar estado
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-3 border text-center text-gray-500">
                                        No hay planes registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
