<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Artisan::call('orchid:admin', [
            'name' => 'admin',
            'email' => 'test1@mail.ru',
            'password' => '12345678'
        ]);

        $user = User::find(1);
        $user->email_verified_at = now();
        $user->save();
    }
}
