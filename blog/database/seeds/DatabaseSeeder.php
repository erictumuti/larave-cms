<?php

use Illuminate\Database\Seeder;

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

        //creates 10 users in database using the faker Postfactory 
        factory('App\User',100)->create()->each(function($user){
        
            //creates 10 posts as to 10 users
            $user->posts()->save(factory('App\Post')->make());
        });
    }
}
