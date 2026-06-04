<?php

namespace App\Http\Controllers;

use App\Models\AccessLog;
use App\Models\QrCode;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function scan()
    {
        $accessLogs = AccessLog::with(['client', 'user'])
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        return view('access.scan', compact('accessLogs'));
    }

    public function validateQr(Request $request)
    {
        $validated = $request->validate([
            'qr_code' => ['required', 'string'],
        ]);

        $code = trim($validated['qr_code']);

        $qrCode = QrCode::with([
            'client.memberships' => function ($query) {
                $query->orderBy('end_date', 'desc');
            }
        ])
            ->where('code', $code)
            ->where('status', 'active')
            ->first();

        if (!$qrCode) {
            AccessLog::create([
                'client_id' => null,
                'user_id' => auth()->id(),
                'qr_code' => $code,
                'result' => 'denied',
                'reason' => 'QR no encontrado o inactivo',
            ]);

            return response()->json([
                'status' => 'denied',
                'title' => 'Acceso denegado',
                'message' => 'El código QR no existe o se encuentra inactivo.',
                'client' => null,
            ]);
        }

        $client = $qrCode->client;

        if (!$client) {
            AccessLog::create([
                'client_id' => null,
                'user_id' => auth()->id(),
                'qr_code' => $code,
                'result' => 'denied',
                'reason' => 'Cliente no encontrado',
            ]);

            return response()->json([
                'status' => 'denied',
                'title' => 'Acceso denegado',
                'message' => 'No se encontró un cliente asociado a este QR.',
                'client' => null,
            ]);
        }

        if ($client->status !== 'active') {
            AccessLog::create([
                'client_id' => $client->id,
                'user_id' => auth()->id(),
                'qr_code' => $code,
                'result' => 'denied',
                'reason' => 'Cliente inactivo',
            ]);

            return response()->json([
                'status' => 'denied',
                'title' => 'Acceso denegado',
                'message' => 'El cliente se encuentra inactivo.',
                'client' => [
                    'name' => $client->first_name . ' ' . $client->last_name,
                    'dni' => $client->dni,
                ],
            ]);
        }

        $activeMembership = $client->memberships()
            ->where('status', 'active')
            ->whereDate('start_date', '<=', now()->toDateString())
            ->whereDate('end_date', '>=', now()->toDateString())
            ->orderBy('end_date', 'desc')
            ->first();

        if (!$activeMembership) {
            AccessLog::create([
                'client_id' => $client->id,
                'user_id' => auth()->id(),
                'qr_code' => $code,
                'result' => 'denied',
                'reason' => 'Membresía vencida o inexistente',
            ]);

            return response()->json([
                'status' => 'denied',
                'title' => 'Acceso denegado',
                'message' => 'El cliente no cuenta con una membresía vigente.',
                'client' => [
                    'name' => $client->first_name . ' ' . $client->last_name,
                    'dni' => $client->dni,
                ],
            ]);
        }

        AccessLog::create([
            'client_id' => $client->id,
            'user_id' => auth()->id(),
            'qr_code' => $code,
            'result' => 'allowed',
            'reason' => 'Membresía vigente',
        ]);

        return response()->json([
            'status' => 'allowed',
            'title' => 'Acceso permitido',
            'message' => 'El cliente cuenta con membresía vigente.',
            'client' => [
                'name' => $client->first_name . ' ' . $client->last_name,
                'dni' => $client->dni,
                'membership_end_date' => $activeMembership->end_date->format('d/m/Y'),
                'plan' => $activeMembership->plan->name,
            ],
        ]);
    }
}
