<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\UserType;
class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'system_admin@carrental.com',
            'password' => \Hash::make('123123123'),
            'phone' => '092817221',
            'identity' => null,
            'status' => 1,
            'role' => UserType::SUPER_ADMIN
        ]);
    }
}
