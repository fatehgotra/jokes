<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Jokes;
use App\Models\JokesCategory;
use App\Models\LeaderBoard;
use App\Models\LocalTrivia;
use App\Models\LocalTriviaQues;
use App\Models\TrueFalse;
use App\Models\TrueFalseQues;
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

        foreach ($jokeCategorys as $jc) {
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
            'rawpass' => 'password',
            'password' => Hash::make('password'),
            'status' => 1
        ]);

        for ($k = 0; $k < 4; $k++) {

            Jokes::create([
                'user_id' => $user->id,
                'category_id' => $faker->randomElement($catIds),
                'joke'    => $faker->randomElement($jokes),
                'status'  => $faker->randomElement([0, 1]),
            ]);
        }




        for ($i = 0; $i < 10; $i++) {

            $user =  User::create([
                'name' =>  $faker->name(),
                'email' => $faker->unique()->email,
                'phone' => $faker->numerify('7#9#8#2####'),
                'rawpass' => 'password',
                'password' => Hash::make('password'),
                'status' => 1,
            ]);

            for ($k = 0; $k < 4; $k++) {

                Jokes::create([
                    'user_id' => $user->id,
                    'category_id' => $faker->randomElement($catIds),
                    'joke'    => $faker->randomElement($jokes),
                    'status'  => $faker->randomElement([0, 1]),
                ]);
            }
        }


        for ($i = 0; $i < 3; $i++) {

            $user =  User::create([
                'name' =>  $faker->name(),
                'email' => $faker->unique()->email,
                'phone' => $faker->numerify('7#9#8#2####'),
                'rawpass' => 'password',
                'password' => Hash::make('password'),
                'status' => 0,
            ]);

            for ($k = 0; $k < 4; $k++) {

                Jokes::create([
                    'user_id' => $user->id,
                    'category_id' => $faker->randomElement($catIds),
                    'joke'    => $faker->randomElement($jokes),
                    'status'  => $faker->randomElement([0, 1]),
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

        /** Local Trivia */

        LocalTrivia::create([
            'name' => 'Local Trivia Questions',
            'description' =>  'select your location to get community-specific questions. Choose from categories like "Famous Landmarks" or "Local Celebrities" and answer multiple-choice questions within a time limit. Use lifelines like "50/50" for help and compete for the top spot on the local leaderboard.',
            'ques_time_limit' => '10',
            'lifeline'  => 2,
            'rules' => '<p>1. You will have only&nbsp;15 seconds&nbsp;per each question.</p>

            <p>2. Once you select your answer, it can&#39;t be undone.</p>
            
            <p>3. You can&#39;t select any option once time goes off.</p>
            
            <p>4. You can&#39;t exit from the game while you&#39;re playing.</p>
            
            <p>5. You&#39;ll get points on the basis of your correct answers.</p>',
            'game_question_limit' => '10',
            'qualified_score' => '4',
            'status' => 1,
        ]);

        $imgs = [
            'https://quizizz.com/media/resource/gs/quizizz-media/quizzes/aeb46cb3-b3c0-46a4-8465-e68dd9d986d7?w=200&h=200',
            'https://quizizz.com/media/resource/gs/quizizz-media/quizzes/36f36db3-bfb5-4b44-bbe4-ee4713e01113?w=900&h=900',
            'https://quizizz.com/media/resource/gs/quizizz-media/quizzes/54dd4adc-d160-4ec1-aa1d-fd84c84e818e?w=900&h=900',
            '',
            '',
            '',
            '',
        ];

        for ($i = 1; $i <= 40; $i++) {
            LocalTriviaQues::create([

                'question' => 'Qustion no. ' . $i . '',
                'option_1' => 'option 1',
                'option_2' => 'option 2',
                'option_3' => 'option 3',
                'option_4' => 'option 4',
                'correct_option' => 'option_2',
                'image'    => $faker->randomElement($imgs),
                'status'   => 1,
            ]);
        }

        for ($i = 1; $i <= 40; $i++) {
            LeaderBoard::create([

                'user_id' => $faker->randomElement([1, 2, 3, 4, 5, 6]),
                'game' => $faker->randomElement(['local-trivia', 'true-false', 'solo-guess-voice', 'solo-guess-celebrity']),
                'score' => $faker->randomElement([2, 3, 4, 10, 5, 6, 7]),
                'status' => 1,
            ]);
        }

        /*True False */

            /** Local Trivia */

            TrueFalse::create([
                'name' => 'True or False',
                'description' =>  'start the game to receive statements related to various topics. Swipe right for "True" and left for "False" within a set time limit for each statement. Use lifelines like "Skip" or "50/50" when stuck, and aim for a high score.',
                'ques_time_limit' => '10',
                'lifeline'  => 0,
                'rules' => '<p>1. You will have only&nbsp;15 seconds&nbsp;per each question.</p>
    
                <p>2. Once you select your answer, it can&#39;t be undone.</p>
                
                <p>3. You can&#39;t select any option once time goes off.</p>
                
                <p>4. You can&#39;t exit from the game while you&#39;re playing.</p>
                
                <p>5. You&#39;ll get points on the basis of your correct answers.</p>',
                'game_question_limit' => '10',
                'qualified_score' => '4',
                'status' => 1,
            ]);
    
            for ($i = 1; $i <= 40; $i++) {
                TrueFalseQues::create([
    
                    'statement' => 'Dummy Statement no. ' . $i . '',
                    'correct_option' => 'true',
                    'status'   => 1,
                ]);
            }
    
        
    }
}
