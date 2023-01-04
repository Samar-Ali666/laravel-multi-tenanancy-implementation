<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Plan;
use App\Models\Tenant;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Plan $plan)
    {
        return view('auth.register', compact('plan'));
    }

    public function tenantSubscribe(Request $request)
    {
        $tenant_details = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Tenant::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        
        $tenant_details = encrypt($tenant_details);

        $tenant = new Tenant();

        $plan = Plan::where('slug', $request->plan)->first();

        return view('show_plan', compact('plan', 'tenant_details', 'tenant'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Tenant::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $tenant = Tenant::create([
            'id' => $request->company,
            'name' => $request->name,
            'company' => $request->company,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $tenant->createDomain([

            'domain' => $request->company_domain
        ]);

        event(new Registered($tenant));

        return redirect(tenant_route($request->company_domain, 'tenant.home'));
    }
}
