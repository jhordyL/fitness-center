<?php

namespace App\Http\Controllers;

use App\Models\AccessLog;
use App\Models\Client;
use App\Models\Membership;
use App\Models\Plan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClients = Client::count();

        $activeClients = Client::where('status', 'active')->count();

        $activePlans = Plan::where('status', 'active')->count();

        $activeMemberships = Membership::where('status', 'active')
            ->whereDate('start_date', '<=', now()->toDateString())
            ->whereDate('end_date', '>=', now()->toDateString())
            ->count();

        $todayAccesses = AccessLog::whereDate('created_at', now()->toDateString())->count();

        $allowedToday = AccessLog::whereDate('created_at', now()->toDateString())
            ->where('result', 'allowed')
            ->count();

        $deniedToday = AccessLog::whereDate('created_at', now()->toDateString())
            ->where('result', 'denied')
            ->count();

        $latestAccessLogs = AccessLog::with(['client', 'user'])
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();

        return view('dashboard', compact(
            'totalClients',
            'activeClients',
            'activePlans',
            'activeMemberships',
            'todayAccesses',
            'allowedToday',
            'deniedToday',
            'latestAccessLogs'
        ));
    }
}
