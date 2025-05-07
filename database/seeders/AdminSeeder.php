<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name'=>'admin1',
            'email'=>'admin1@admin.com',
            'password'=>bcrypt('12345678'),
            'email_verified_at'=>Carbon::now()
        ]);
        $admin->assignRole('admin');
    }
}
