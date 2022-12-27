<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name' => 'Basic Plan',
                'slug' => 'basic-plan',
                'stripe_plan' => 'price_1MITpfGwqrC02TkepXHH3NmJ',
                'price' => 10,
                'description' => 'This is basic plan'
            ],
            [
                'name' => 'Standard Plan',
                'slug' => 'standard-plan',
                'stripe_plan' => 'price_1MITqkGwqrC02TkeUbp27euZ',
                'price' => 20,
                'description' => 'This is standard plan'
            ],
            [
                'name' => 'Premiuim Plan',
                'slug' => 'premium-plan',
                'stripe_plan' => 'price_1MITruGwqrC02TkeOJssC6dQ',
                'price' => 30,
                'description' => 'This is premium plan'
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
