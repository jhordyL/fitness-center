<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\QrCode;
use Illuminate\Support\Str;

class QrCodeController extends Controller
{
    public function show(Client $client)
    {
        $qrCode = $client->qrCode;

        return view('qr-codes.show', compact('client', 'qrCode'));
    }

    public function generate(Client $client)
    {
        $code = 'FC-CLIENT-' . $client->id . '-' . strtoupper(Str::random(10));

        QrCode::updateOrCreate(
            ['client_id' => $client->id],
            [
                'code' => $code,
                'status' => 'active',
            ]
        );

        return redirect()
            ->route('clients.qr.show', $client)
            ->with('success', 'Código QR generado correctamente.');
    }

    public function regenerate(Client $client)
    {
        $code = 'FC-CLIENT-' . $client->id . '-' . strtoupper(Str::random(10));

        QrCode::updateOrCreate(
            ['client_id' => $client->id],
            [
                'code' => $code,
                'status' => 'active',
            ]
        );

        return redirect()
            ->route('clients.qr.show', $client)
            ->with('success', 'Código QR regenerado correctamente.');
    }
}
