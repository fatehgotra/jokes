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
            '<p><b>What do a tick and the Eiffel tower have in common?</b></p><p>They’re both Paris sites.</p>',
            '<p><b>What did the ocean say to the shore?</b></p><p>Nothing, it just waved.</p>',
            '<p><b>When does a joke become a dad joke?</b></p><p>When it’s apparent.</p>',
            '<p><b>What did summer say to spring?</b></p><p>I’m going to fall!</p>',
            '<p><b>What did one snowman say to another?</b></p><p>Wait, do you smell carrots?</p>',
            '<p><b>What did the hungry clock do?</b></p><p>It went back 4 seconds.</p>',
            '<p><b>What’s the tallest building in the world? A library, of course. It has so many stories!</b></p>',
            '<p><b>I always take life with a grain of salt. And a slice of lemon. And a shot of tequila!</b></p>',
            '<p><b>I know they say that money talks… ...But all mine says is “Goodbye!”</b></p>',
            '<p><b>I tried to catch fog the other day.</b></p><p>But I mist.</p>',
            '<p><b>Let’s start telling people their brain is an app.</b></p><p>Maybe then they’ll want to use it!</p>',
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
