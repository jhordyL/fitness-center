<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Validación de acceso por QR
            </h2>

            <a href="{{ route('dashboard') }}"
               style="background-color: #6b7280; color: white; padding: 8px 14px; border-radius: 6px; text-decoration: none; font-weight: 600;">
                Volver al dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; align-items: start;">

                <div style="background: white; border-radius: 10px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                    <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 16px;">
                        Escanear código QR
                    </h3>

                    <div id="reader" style="width: 100%; max-width: 420px; margin: auto;"></div>

                    <div style="margin-top: 20px;">
                        <label style="display: block; margin-bottom: 6px; font-weight: 600;">
                            Validación manual del código
                        </label>

                        <div style="display: flex; gap: 8px;">
                            <input type="text"
                                   id="manual_qr_code"
                                   placeholder="Pegue o escriba el código QR"
                                   style="flex: 1; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">

                            <button type="button"
                                    onclick="validateManualCode()"
                                    style="background-color: #111827; color: white; padding: 10px 14px; border-radius: 6px; border: none; cursor: pointer;">
                                Validar
                            </button>
                        </div>
                    </div>
                </div>

                <div style="background: white; border-radius: 10px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
                    <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 16px;">
                        Resultado
                    </h3>

                    <div id="result-box"
                         style="padding: 24px; border-radius: 10px; background-color: #f3f4f6; color: #374151; min-height: 180px;">
                        <h4 id="result-title" style="font-size: 24px; font-weight: 800; margin-bottom: 10px;">
                            Esperando lectura
                        </h4>

                        <p id="result-message" style="font-size: 16px; margin-bottom: 12px;">
                            Escanee un código QR o ingrese el código manualmente.
                        </p>

                        <div id="client-info" style="font-size: 15px;"></div>
                    </div>
                </div>

            </div>

            <div style="background: white; border-radius: 10px; padding: 24px; margin-top: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); overflow-x: auto;">
                <h3 style="font-size: 20px; font-weight: 700; margin-bottom: 16px;">
                    Últimas validaciones
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
                        @forelse ($accessLogs as $log)
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

    <script>
        let lastScannedCode = null;
        let isProcessing = false;

        function showResult(data) {
            const resultBox = document.getElementById('result-box');
            const resultTitle = document.getElementById('result-title');
            const resultMessage = document.getElementById('result-message');
            const clientInfo = document.getElementById('client-info');

            resultTitle.innerText = data.title;
            resultMessage.innerText = data.message;

            if (data.status === 'allowed') {
                resultBox.style.backgroundColor = '#dcfce7';
                resultBox.style.color = '#166534';
            } else {
                resultBox.style.backgroundColor = '#fee2e2';
                resultBox.style.color = '#991b1b';
            }

            if (data.client) {
                let html = `
                    <p><strong>Cliente:</strong> ${data.client.name}</p>
                    <p><strong>DNI:</strong> ${data.client.dni}</p>
                `;

                if (data.client.plan) {
                    html += `<p><strong>Plan:</strong> ${data.client.plan}</p>`;
                }

                if (data.client.membership_end_date) {
                    html += `<p><strong>Vence:</strong> ${data.client.membership_end_date}</p>`;
                }

                clientInfo.innerHTML = html;
            } else {
                clientInfo.innerHTML = '';
            }
        }

        async function validateQrCode(qrCode) {
            if (!qrCode || isProcessing) {
                return;
            }

            if (qrCode === lastScannedCode) {
                return;
            }

            lastScannedCode = qrCode;
            isProcessing = true;

            try {
                const response = await fetch("{{ route('access.validate') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        qr_code: qrCode
                    })
                });

            const data = await response.json();
            showResult(data);

            setTimeout(() => {
                isProcessing = false;
                lastScannedCode = null;
                window.location.reload();
            }, 2500);

            } catch (error) {
                showResult({
                    status: 'denied',
                    title: 'Error de validación',
                    message: 'No se pudo validar el código QR.',
                    client: null
                });

                isProcessing = false;
                lastScannedCode = null;
            }
        }

        function validateManualCode() {
            const input = document.getElementById('manual_qr_code');
            validateQrCode(input.value.trim());
            input.value = '';
        }

        document.addEventListener('DOMContentLoaded', function () {
            if (!window.Html5QrcodeScanner) {
                showResult({
                    status: 'denied',
                    title: 'Lector QR no disponible',
                    message: 'La librería de escaneo QR no se cargó correctamente.',
                    client: null
                });
                return;
            }

            const scanner = new window.Html5QrcodeScanner(
                "reader",
                {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    }
                },
                false
            );

            scanner.render(function (decodedText) {
                validateQrCode(decodedText);
            });
        });
    </script>
</x-app-layout>
