<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Tenant;

class PlanController extends Controller
{
    public function createSubscription(Request $request)
    {
        $tenant_details = decrypt($request->tenant_details);
        $plan = Plan::findOrFail($request->plan);

        $tenant = Tenant::create([
            'id' => $tenant_details['company'],
            'name' => $tenant_details['name'],
            'company' => $tenant_details['company'],
            'email' => $tenant_details['email'],
            'password' => $tenant_details['password']
        ]);

        $tenant->newSubscription($request->plan, $plan->stripe_plan)->create($request->token);

        return view('success_subscription');

    }
}
