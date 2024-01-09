<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\GroupGuessCelebrity;
use App\Models\GroupGuessCelebrityQues;
use App\Models\GroupGuessLocation;
use App\Models\GroupGuessLocationQues;
use App\Models\GroupGuessVoice;
use App\Models\GroupGuessVoiceQues;
use App\Models\GroupMembers;
use App\Models\Groups;
use App\Models\GroupScores;
use App\Models\GuessLocalCelb;
use App\Models\GuessLocalCelbQues;
use App\Models\GuessTheVoice;
use App\Models\GuessTheVoiceQues;
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

        $gp = Groups::create([
            'name' => 'Test Group',
            'game_name' => 'group_location',
            'avatar' => '',
            'creator' => $user->id
        ]);


        GroupScores::create(
            [
                'group_id' => $gp->id,
                'game'     => 'group_location',
                'score'    =>  '7',
                'status'   => 1,
                'image'    => '',
            ]
        );

        GroupScores::create(
            [
                'group_id' => $gp->id,
                'game'     => 'group_guess_voice',
                'score'    =>  '6',
                'status'   => 1,
                'image'    => '',
            ]
        );

        GroupScores::create(
            [
                'group_id' => $gp->id,
                'game'     => 'group_guess_celebrity',
                'score'    =>  '8',
                'status'   => 1,
                'image'    => '',
            ]
        );


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


        for ($i = 0; $i < 4; $i++) {

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

            GroupMembers::create([
                'group_id' => $gp->id,
                'email' => ($i == 0) ? 'user@site.com' : $user->email,
                'display_name' => $user->name,
                'password' => Hash::make('password'),
            ]);
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

        $trivia = [
            [
                'q' => 'What is the capital city of Fiji?',
                'o' => [
                    'Nadi',
                    'Suva',
                    'Lautoka',
                    'Labasa'
                ],
                'a' => 'option_2'
            ],
            [
                'q' => 'Which famous reef, known for its diverse marine life, is located near the Fiji Islands?',
                'o' => [
                    'Great Barrier Reef',
                    'Mesoamerican Barrier Reef',
                    'Fiji Barrier Reef',
                    'Great Astrolabe Reef'
                ],
                'a' => 'option_4'
            ],
            [
                'q' => 'Fiji gained independence from British rule in which year?',
                'o' => [
                    '1967',
                    '1970',
                    '1985',
                    '1992'
                ],
                'a' => 'option_2'
            ],
            [
                'q' => 'What is the traditional Fijian drink made from the root of the yaqona plant?',
                'o' => [
                    'Kava',
                    'Coconut Water',
                    'Taro Juice',
                    'Mango Lassi'
                ],
                'a' => 'option_1'
            ],
            [
                'q' => 'Which popular festival celebrates Fijian culture and is often referred to as the "Fiji Day"?',
                'o' => [
                    'Hibiscus Festival',
                    'Bula Festival',
                    'Diwali Festival',
                    'Independence Day Festival'
                ],
                'a' => 'option_4'
            ],
            [
                'q' => 'What is the name of the famous Fijian dish made with marinated raw fish?',
                'o' => [
                    'Lovo',
                    'Kokoda',
                    'Bouma',
                    'Rourou'
                ],
                'a' => 'option_2'
            ],
            [
                'q' => 'Which group of islands is renowned for its luxury resorts and crystal-clear waters in Fiji?',
                'o' => [
                    'Yasawa Islands',
                    'Kadavu Islands',
                    'Mamanuca Islands',
                    'Lau Islands'
                ],
                'a' => 'option_3'
            ],
            [
                'q' => 'Fiji is made up of how many main islands?',
                'o' => [
                    '79',
                    '152',
                    '333',
                    '600'
                ],
                'a' => 'option_3'
            ],
            [
                'q' => 'What is the traditional Fijian method of cooking food underground using heated stones called?',
                'o' => [
                    'Lovo',
                    'Bouma',
                    'Rewa',
                    'Nadi'
                ],
                'a' => 'option_1'
            ],
            [
                'q' => 'Which Fijian word is commonly used to greet someone and means "hello" or "welcome"?',
                'o' => [
                    'Bula',
                    'Vinaka',
                    'Moce',
                    'Malo'
                ],
                'a' => 'option_1'
            ]
        ];

        foreach ($trivia as $k => $t) {
            LocalTriviaQues::create([

                'question' => $t['q'],
                'option_1' => $t['o'][0],
                'option_2' => $t['o'][1],
                'option_3' => $t['o'][2],
                'option_4' => $t['o'][3],
                'correct_option' => $t['a'],
                'image'    => '',
                'status'   => 1,
            ]);
        }

        for ($i = 1; $i <= 40; $i++) {
            LeaderBoard::create([

                'user_id' => $faker->randomElement([1, 2, 3, 4, 5, 6]),
                'game' => $faker->randomElement(['local-trivia', 'true-false', 'guess-the-voice', 'guess-local-celebrity']),
                'score' => $faker->randomElement([2, 3, 4, 10, 5, 6, 7]),
                'status' => 1,
            ]);
        }

           /** Guess The Local Celebrity */

           GuessLocalCelb::create([
            'name' => 'Guess the local celebrity',
            'description' =>  '"Guess the Local Celebrity" is a fun and interactive mobile game that tests your knowledge of famous faces in your community. Identify the blurred or pixelated faces from multiple-choice options within a time limit. Use lifelines like "Hint" or "50/50" when stuck, and compete for the top spot on the local leaderboard.',
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
            'data:image/jpeg;base64,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',
            'data:image/jpeg;base64,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',
            'data:image/jpeg;base64,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',
            'https://i.insider.com/612f86d79ef1e50018f92070?width=700',
            'data:image/jpeg;base64,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'
        ];

        for ($i = 1; $i <= 40; $i++) {
            GuessLocalCelbQues::create([

                'question' => 'Guess celebrity no. ' . $i . '',
                'option_1' => 'option 1',
                'option_2' => 'option 2',
                'option_3' => 'option 3',
                'option_4' => 'option 4',
                'correct_option' => 'option_2',
                'image'    => $faker->randomElement($imgs),
                'status'   => 1,
            ]);
        }

        /*Guess The Voice */

        GuessTheVoice::create([
            'name' => 'Guess The Voice',
            'description' =>  'Listen to short audio snippets and choose who you think the voice belongs to from multiple-choice options. Use lifelines like "Replay Voice" or "50/50" for help, and aim to top the local leaderboard. Whether it\'s local celebrities, politicians, famous local sports stars, influencers etc',
            'ques_time_limit' => '10',
            'lifeline'  => 2,
            'rules' => '<p>1. You will have only&nbsp;15 seconds&nbsp;per each question.</p>
    
                <p>2. Once you select your answer, it can&#39;t be undone.</p>
                
                <p>3. You can&#39;t select any option once time goes off.</p>
                
                <p>4. You can&#39;t exit from the game while you&#39;re playing.</p>
                
                <p>5. You&#39;ll get points on the basis of your correct answers.</p>',
            'game_question_limit' => '15',
            'qualified_score' => '4',
            'status' => 1,
        ]);

        for ($i = 1; $i <= 40; $i++) {
            GuessTheVoiceQues::create([

                'text' => 'Play and Gues The Voice no. ' . $i . '',
                'file' => $faker->randomElement($jokes),
                'option_1' => 'option 1',
                'option_2' => 'option 2',
                'option_3' => 'option 3',
                'option_4' => 'option 4',
                'correct_option' => 'option_2',
                'status'   => 1,
            ]);
        }

         /*True False */

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

        $trueFalse = [

            ['q' => 'True or False: The traditional Fijian greeting, "Bula," means "goodbye."', 'a' =>'False'],
            ['q' => 'True or False: The Bouma National Heritage Park is located on the island of Viti Levu.', 'a' =>'False'],
            ['q' => 'True or False: Fiji was once a colony of France before becoming a British territory.', 'a' =>'False'],
            ['q' => 'True or False: The Fijian archipelago is located in the South Pacific Ocean.', 'a' =>'True'],
            ['q' => 'True or False: The Fijian Parliament is known as the "Bicameral Parliament.', 'a' =>'True'],
            ['q' => 'True or False: The traditional Fijian dance, "Meke," is performed to celebrate special occasions and events.', 'a' =>'True'],
            ['q' => 'True or False: The Yasawa Islands are known for their rugged landscapes and secluded beaches.', 'a' =>'True'],
            ['q' => 'True or False: Fiji has never won an Olympic gold medal in any sport.', 'a' =>'False'],
            ['q' => 'True or False: The Indo-Fijian community comprises a significant portion of Fiji\'s population.', 'a' =>'True'],
            ['q' => 'True or False: The "Firewalking Ceremony" is a traditional Fijian ritual performed by the Sawau tribe.', 'a' =>'True'],
        ];

        foreach($trueFalse as $k => $tf) {
            TrueFalseQues::create([

                'statement' => $tf['q'],
                'correct_option' => $tf['a'],
                'status'   => 1,
            ]);
        }

        /****************GroupGames************************* */

        /** Group Guess Location */

        GroupGuessLocation::create([
            'name' => 'Guess The Location',
            'description' =>  'view the displayed image of a place. Choose the correct location from multiple-choice options within a time limit.',
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

        $imgs_gl = [
            'https://quizizz.com/media/resource/gs/quizizz-media/quizzes/aeb46cb3-b3c0-46a4-8465-e68dd9d986d7?w=200&h=200',
            'https://quizizz.com/media/resource/gs/quizizz-media/quizzes/36f36db3-bfb5-4b44-bbe4-ee4713e01113?w=900&h=900',
            'https://quizizz.com/media/resource/gs/quizizz-media/quizzes/54dd4adc-d160-4ec1-aa1d-fd84c84e818e?w=900&h=900',
        ];

        for ($i = 1; $i <= 40; $i++) {
            GroupGuessLocationQues::create([

                'question' => 'Guess the following location in image ' . $i . '',
                'option_1' => 'option 1',
                'option_2' => 'option 2',
                'option_3' => 'option 3',
                'option_4' => 'option 4',
                'correct_option' => 'option_2',
                'image'    => $faker->randomElement($imgs_gl),
                'status'   => 1,
            ]);
        }

          /** Group Guess Celebrity */

          GroupGuessCelebrity::create([
            'name' => 'Guess The Celebrity',
            'description' =>  '"Guess the Local Celebrity" is a fun and interactive mobile game that tests your knowledge of famous faces in your community. Identify the blurred or pixelated faces from multiple-choice options within a time limit. Use lifelines like "Hint" or "50/50" when stuck, and compete for the top spot on the local leaderboard.',
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


        for ($i = 1; $i <= 40; $i++) {
            GroupGuessCelebrityQues::create([

                'question' => 'Guess the following celebrity in image ' . $i . '',
                'option_1' => 'option 1',
                'option_2' => 'option 2',
                'option_3' => 'option 3',
                'option_4' => 'option 4',
                'correct_option' => 'option_2',
                'image'    => $faker->randomElement($imgs),
                'status'   => 1,
            ]);
        }


        /* Group Guess Voice */

        GroupGuessVoice::create([
            'name' => 'Guess The Voice',
            'description' =>  'Listen to short audio snippets and choose who you think the voice belongs to from multiple-choice options. Use lifelines like "Replay Voice" or "50/50" for help, and aim to top the local leaderboard. Whether it\'s local celebrities, politicians, famous local sports stars, influencers etc.',
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


        for ($i = 1; $i <= 40; $i++) {
            GroupGuessVoiceQues::create([

                'question' => 'Guess the voice in following ' . $i . '',
                'option_1' => 'option 1',
                'option_2' => 'option 2',
                'option_3' => 'option 3',
                'option_4' => 'option 4',
                'correct_option' => 'option_2',
                'file'    =>  $faker->randomElement($jokes),
                'status'   => 1,
            ]);
        }
    }
}
