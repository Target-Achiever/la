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
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456'),
			'user_status' => 'active',
			'user_type' => 'end_user'
        ]);
		DB::table('users')->insert([
            'name' => 'provider1',
            'email' => 'provider1@gmail.com',
            'password' => bcrypt('123456'),
			'user_status' => 'active',
			'user_type' => 'prescriber'
        ]);
        DB::table('users')->insert([
            'name' => 'provider2',
            'email' => 'provider2@gmail.com',
            'password' => bcrypt('123456'),
            'user_status' => 'active',
            'user_type' => 'prescriber'
        ]);
        DB::table('users')->insert([
            'name' => 'provider3',
            'email' => 'provider3@gmail.com',
            'password' => bcrypt('123456'),
            'user_status' => 'active',
            'user_type' => 'prescriber'
        ]);
        DB::table('users')->insert([
            'name' => 'provider4',
            'email' => 'provider4@gmail.com',
            'password' => bcrypt('123456'),
            'user_status' => 'active',
            'user_type' => 'prescriber'
        ]);
        DB::table('users')->insert([
            'name' => 'provider5',
            'email' => 'provider5@gmail.com',
            'password' => bcrypt('123456'),
            'user_status' => 'active',
            'user_type' => 'prescriber'
        ]);
		DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
			'user_status' => 'active',
			'user_type' => 'super_admin'
        ]);
    }
}
