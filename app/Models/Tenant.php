<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Laravel\Cashier\Billable;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, Billable;


    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'company',
            'email',
            'password',
            'remember_token',
            'stripe_id',
            'pm_type',
            'pm_last_four',
            'trial_ends_at'
        ];
    }
}