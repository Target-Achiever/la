<?php

use Illuminate\Database\Seeder;

class UserDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_details')->insert([
        	'user_id' => '14',
        	'title' => 'Mr',
        	'surname' => 'SU',
            'forename' => 'provider',
			'date_of_birth' => '1990-08-30',
			'nationality' => 'indian',
            'address_line_1' => 'chennai',
            'address_line_2' => 'Chennai, Tamil Nadu, India',
            'country' => 'india',
            'country' => 'india',
            'state' => 'TN',
            'city' => 'chennai',
            'post_code' => '600100',
            'phone' => '900000000',
            'business' => '90000000',
            'business_address' => 'address demo',
            'latitude' => '13.0480438',
            'longitude' => '79.9288063'
        ]);
		DB::table('user_details')->insert([
			'user_id' => '15',
        	'title' => 'Mr',
        	'surname' => 'SU',
            'forename' => 'provider2',
			'date_of_birth' => '1990-08-30',
			'nationality' => 'Egypt',
            'address_line_1' => 'Egypt',
            'address_line_2' => 'Egypt',
            'country' => 'Egypt',
            'country' => 'Egypt',
            'state' => 'TN',
            'city' => 'Egypt',
            'post_code' => '600100',
            'phone' => '900000000',
            'business' => '90000000',
            'business_address' => 'address demo',
            'latitude' => '26.8447066',
            'longitude' => '26.3798881'
        ]);
		DB::table('user_details')->insert([
			'user_id' => '16',
        	'title' => 'Mr',
        	'surname' => 'SU',
            'forename' => 'provider3',
			'date_of_birth' => '1990-08-30',
			'nationality' => 'Africa',
            'address_line_1' => 'Atebubu',
            'address_line_2' => 'Atebubu, Ghana',
            'country' => 'Africa',
            'country' => 'Africa',
            'state' => 'Ghana',
            'city' => 'Ghana',
            'post_code' => '600100',
            'phone' => '900000000',
            'business' => '90000000',
            'business_address' => 'address demo',
            'latitude' => '7.7532401',
            'longitude' => '-0.9924603'
        ]);
        DB::table('user_details')->insert([
        	'user_id' => '17',
        	'title' => 'Mr',
        	'surname' => 'SU',
            'forename' => 'provider4',
			'date_of_birth' => '1990-08-30',
			'nationality' => 'Ethiopia',
            'address_line_1' => 'Algeria Street, Addis Ababa, Ethiop',
            'address_line_2' => 'Algeria Street, Addis Ababa, Ethiop',
            'country' => 'Ethiopia',
            'country' => 'Ethiopia',
            'state' => 'Ethiopia',
            'city' => 'Ethiopia',
            'post_code' => '600100',
            'phone' => '900000000',
            'business' => '90000000',
            'business_address' => 'address demo',
            'latitude' => '9.052919',
            'longitude' => '38.7602084'
        ]);
        DB::table('user_details')->insert([
            'user_id' => '18',
            'title' => 'Mr',
            'surname' => 'SU',
            'forename' => 'provider5',
            'date_of_birth' => '1990-08-30',
            'nationality' => 'Ethiopia',
            'address_line_1' => 'Algeria Street, Addis Ababa, Ethiop',
            'address_line_2' => 'Algeria Street, Addis Ababa, Ethiop',
            'country' => 'Ethiopia',
            'country' => 'Ethiopia',
            'state' => 'Ethiopia',
            'city' => 'Ethiopia',
            'post_code' => '600100',
            'phone' => '900000000',
            'business' => '90000000',
            'business_address' => 'address demo',
            'latitude' => '9.052919',
            'longitude' => '38.7602084'
        ]);
    }
}
