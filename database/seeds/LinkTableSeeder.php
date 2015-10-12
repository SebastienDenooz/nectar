<?php

use Illuminate\Database\Seeder;

class LinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++){
            $link = factory(App\Link::class)->make()->toArray();
            $link['user_id'] = \App\User::find(rand(1,9))->id;
            \App\Link::create($link)->save();
            $link = [];
        }
    }
}
