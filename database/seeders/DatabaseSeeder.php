<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Jokes;
use App\Models\JokesCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //seed users 
        $faker = \Faker\Factory::create();

        $catIds = [];

        $jokeCategorys = [
            
            'Funny local stories',
            'Grog Jokes',
            'Local One Liners',
            'Observational',
            'Anecdotal',
            'Situational',
            'Character',
            'Ironic',
            'Deadpan',
            'Farcical',
            'Self-deprecating',
            'Slapstick'
        ];

        foreach( $jokeCategorys as $jc ){
            $c = JokesCategory::create([
                'category' => $jc,
                'status'   => 1
            ]);

            $catIds[] = $c->id;
        }

        $jokes = [
            '9962.mp3',
            '9963.mp3',
            '9964.mp3',
            '9965.mp3',
            '9966.mp3',
            '9967.mp3',

        ];

       $user =  User::create([
            'name' => 'Demo User',
            'email' => 'user@site.com',
            'phone' => $faker->numerify('7#9#8#2####'),
            'rawpass'=> 'password',
            'password' => Hash::make('password'),
            'status' => 1
        ]);

        for( $k = 0; $k < 4; $k++){

            Jokes::create([
                'user_id' => $user->id,
                'category_id' => $faker->randomElement($catIds),
                'joke'    => $faker->randomElement($jokes),
                'status'  => $faker->randomElement([0,1]),
            ]);
        }


    

        for($i = 0; $i < 10; $i++){
         
           $user =  User::create([
                'name' =>  $faker->name(),
                'email' => $faker->unique()->email,
                'phone' => $faker->numerify('7#9#8#2####'),
                'rawpass'=> 'password',
                'password' => Hash::make('password'),
                'status' => 1,
            ]);

            for( $k = 0; $k < 4; $k++){

                Jokes::create([
                    'user_id' => $user->id,
                    'category_id' => $faker->randomElement($catIds),
                    'joke'    => $faker->randomElement($jokes),
                    'status'  => $faker->randomElement([0,1]),
                ]);
            }

        }


        for($i = 0; $i < 3; $i++){
         
           $user =  User::create([
                'name' =>  $faker->name(),
                'email' => $faker->unique()->email,
                'phone' => $faker->numerify('7#9#8#2####'),
                'rawpass'=> 'password',
                'password' => Hash::make('password'),
                'status' => 0,
            ]);

            for( $k = 0; $k < 4; $k++){

                Jokes::create([
                    'user_id' => $user->id,
                    'category_id' => $faker->randomElement($catIds),
                    'joke'    => $faker->randomElement($jokes),
                    'status'  => $faker->randomElement([0,1]),
                ]);
            }

        }

        

        Admin::create([
            'name' => 'Ritesh',
            'email' => 'admin@admin.com',
            'phone' => $faker->numerify('7#9#8#2####'),
            'password' => Hash::make('password')
        ]);

        // $this->call(WebsiteSeeder::class);
    }
}
