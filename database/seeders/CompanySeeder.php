<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name' => 'Demo Company',
            'subdomain' => 'demo',
            'tariff' => 'free'
        ]);

        Company::create([
            'name' => 'Test COmpany',
            'subdomain' => 'test1',
            'tariff' => 'business'
        ]);
    }
}
