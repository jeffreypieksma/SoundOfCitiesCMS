<?php

use Illuminate\Database\Seeder;

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
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'password' => bcrypt('admin'),
        'remember_token' => str_random(10),
        'email_verified_at' => now(),
    ]);
    factory(App\User::class, 15)->create(); 
    }
}