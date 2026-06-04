<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar cliente
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div style="background: white; border-radius: 10px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">

                <form action="{{ route('clients.store') }}" method="POST">
                    @csrf

                    <div style="margin-bottom: 16px;">
                        <label>DNI</label>
                        <input type="text" name="dni" value="{{ old('dni') }}"
                               style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                        @error('dni') <p style="color: red;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label>Nombres</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                               style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                        @error('first_name') <p style="color: red;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label>Apellidos</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                               style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                        @error('last_name') <p style="color: red;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label>Teléfono</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                        @error('phone') <p style="color: red;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label>Correo</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                        @error('email') <p style="color: red;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom: 16px;">
                        <label>Estado</label>
                        <select name="status"
                                style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                            <option value="active">Activo</option>
                            <option value="inactive">Inactivo</option>
                        </select>
                        @error('status') <p style="color: red;">{{ $message }}</p> @enderror
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 8px;">
                        <a href="{{ route('clients.index') }}"
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
