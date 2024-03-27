<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class createRandomAuctions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-random-auctions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //create random users
        for ($i = 0; $i < 100; $i++) {
            $user = new \App\Models\User();
            $user->name = 'User ' . $i;
            $user->email = 'user' . $i . '@AdeerChallenges.test';
            $user->password = bcrypt('password');
            $user->save();
        }
        //create 1000 auctions with random data with faker
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 1000; $i++) {
            $auction = new \App\Models\Auction();
            $auction->title = $faker->sentence;
            $auction->description = $faker->text;
            $auction->price = $faker->randomFloat(2, 1, 1000);
            $auction->ends_at = $faker->dateTimeBetween('now', '+1 month');
            $auction->user_id = $faker->numberBetween(1, 100);
            $auction->save();
        }
    }
}
