<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'user_id' => Uuid::uuid4(),
            'name' => 'Admin Admin',
            'email' => 'admin@saga.com',
            'email_verified_at' => now(),
            'phone_number' => '081234567890',
            'role' => 'superadmin',
            'status' => 'active',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
