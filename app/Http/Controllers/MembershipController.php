<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Membership;
use App\Models\Plan;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $memberships = Membership::with(['client', 'plan'])
            ->when($search, function ($query, $search) {
                $query->whereHas('client', function ($clientQuery) use ($search) {
                    $clientQuery->where('dni', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('memberships.index', compact('memberships', 'search'));
    }

    public function create()
    {
        $clients = Client::where('status', 'active')->orderBy('first_name')->get();
        $plans = Plan::where('status', 'active')->orderBy('name')->get();

        return view('memberships.create', compact('clients', 'plans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => ['required', 'exists:clients,id'],
            'plan_id' => ['required', 'exists:plans,id'],
            'start_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        $plan = Plan::findOrFail($validated['plan_id']);

        $endDate = date('Y-m-d', strtotime($validated['start_date'] . ' +' . $plan->duration_days . ' days'));

        Membership::create([
            'client_id' => $validated['client_id'],
            'plan_id' => $validated['plan_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $endDate,
            'status' => 'active',
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('memberships.index')
            ->with('success', 'Membresía registrada correctamente.');
    }

    public function edit(Membership $membership)
    {
        $clients = Client::where('status', 'active')->orderBy('first_name')->get();
        $plans = Plan::where('status', 'active')->orderBy('name')->get();

        return view('memberships.edit', compact('membership', 'clients', 'plans'));
    }

    public function update(Request $request, Membership $membership)
    {
        $validated = $request->validate([
            'client_id' => ['required', 'exists:clients,id'],
            'plan_id' => ['required', 'exists:plans,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'status' => ['required', 'in:active,expired,cancelled'],
            'notes' => ['nullable', 'string'],
        ]);

        $membership->update($validated);

        return redirect()
            ->route('memberships.index')
            ->with('success', 'Membresía actualizada correctamente.');
    }

    public function destroy(Membership $membership)
    {
        $membership->update([
            'status' => $membership->status === 'cancelled' ? 'active' : 'cancelled',
        ]);

        return redirect()
            ->route('memberships.index')
            ->with('success', 'Estado de la membresía actualizado correctamente.');
    }
}
