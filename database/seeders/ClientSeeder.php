<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $phones = [
            '+7-935-552-3707',
            '+7-901-555-8527',
            '+7-908-555-4206',
            '+7-915-556-7774',
            '+7-953-555-5885'
        ];

        foreach ($phones as $row) {
            $row = preg_replace('/[^0-9+]/', '', $row);
            Client::create([
                'phone' => $row
            ]);
        }

    }
}
