<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar membresía
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div style="background: white; border-radius: 10px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">

                <form action="{{ route('memberships.update', $membership) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom: 16px;">
                        <label>Cliente</label>
                        <select name="client_id"
                                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id', $membership->client_id) == $client->id ? 'selected' : '' }}>
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
                            @foreach ($plans as $plan)
                                <option value="{{ $plan->id }}" {{ old('plan_id', $membership->plan_id) == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->name }} - {{ $plan->duration_days }} días - S/ {{ number_format($plan->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                        @error('plan_id') <p style="color: red;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label>Fecha de inicio</label>
                        <input type="date" name="start_date" value="{{ old('start_date', $membership->start_date->format('Y-m-d')) }}"
                               style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                        @error('start_date') <p style="color: red;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label>Fecha de vencimiento</label>
                        <input type="date" name="end_date" value="{{ old('end_date', $membership->end_date->format('Y-m-d')) }}"
                               style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                        @error('end_date') <p style="color: red;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label>Estado</label>
                        <select name="status"
                                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                            <option value="active" {{ old('status', $membership->status) === 'active' ? 'selected' : '' }}>Activa</option>
                            <option value="expired" {{ old('status', $membership->status) === 'expired' ? 'selected' : '' }}>Vencida</option>
                            <option value="cancelled" {{ old('status', $membership->status) === 'cancelled' ? 'selected' : '' }}>Cancelada</option>
                        </select>
                        @error('status') <p style="color: red;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label>Observaciones</label>
                        <textarea name="notes" rows="3"
                                  style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">{{ old('notes', $membership->notes) }}</textarea>
                        @error('notes') <p style="color: red;">{{ $message }}</p> @enderror
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 8px;">
                        <a href="{{ route('memberships.index') }}"
                           style="background-color: #6b7280; color: white; padding: 9px 14px; border-radius: 6px; text-decoration: none;">
                            Cancelar
                        </a>

                        <button type="submit"
                                style="background-color: #4f46e5; color: white; padding: 9px 14px; border-radius: 6px; border: none; cursor: pointer;">
                            Actualizar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
