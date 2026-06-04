<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar membresía
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div style="background: white; border-radius: 10px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">

                <form action="{{ route('memberships.store') }}" method="POST">
                    @csrf

                    <div style="margin-bottom: 16px;">
                        <label>Cliente</label>
                        <select name="client_id"
                                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                            <option value="">Seleccione un cliente</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->first_name }} {{ $client->last_name }} - DNI: {{ $client->dni }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id') <p style="color: red;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label>Plan</label>
                        <select name="plan_id"
                                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                            <option value="">Seleccione un plan</option>
                            @foreach ($plans as $plan)
                                <option value="{{ $plan->id }}" {{ old('plan_id') == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->name }} - {{ $plan->duration_days }} días - S/ {{ number_format($plan->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                        @error('plan_id') <p style="color: red;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label>Fecha de inicio</label>
                        <input type="date" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}"
                               style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                        @error('start_date') <p style="color: red;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label>Observaciones</label>
                        <textarea name="notes" rows="3"
                                  style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">{{ old('notes') }}</textarea>
                        @error('notes') <p style="color: red;">{{ $message }}</p> @enderror
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 8px;">
                        <a href="{{ route('memberships.index') }}"
                           style="background-color: #6b7280; color: white; padding: 9px 14px; border-radius: 6px; text-decoration: none;">
                            Cancelar
                        </a>

                        <button type="submit"
                                style="background-color: #4f46e5; color: white; padding: 9px 14px; border-radius: 6px; border: none; cursor: pointer;">
                            Guardar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
