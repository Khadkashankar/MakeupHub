<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        	// $data = new User(
        	// 	[
        	// 		'name'=> Str::random(10),
        	// 		'phone'=> random_int(0000000000,9999999999),
        	// 		'usertype'=> "user",
        	// 		'type'=> 1,
        	// 		'email' => Str::random(9)."@gmail.com",
        	// 		'password' => Hash::make(Str::random(8)),
        	// 	]);

        	// $data->save();

        	$data1 = new User(
        		[
        			'name'=> "admin",
        			'phone'=> 9814678481,
        			'usertype'=> "admin",
        			'email' => "admin@gmail.com",
        			'password' => Hash::make("admin123"),
        		]
            );

        	$data1->save();

            $data2 = new User(
            [
                    'name'=> "Hari khadka",
                    'phone'=> 9999955555,
                    'usertype'=> "user",
                    'email' => "hari@gmail.com",
                    'password' => Hash::make("hari123"),
                ]);
            $data2->save();
        }
    }
