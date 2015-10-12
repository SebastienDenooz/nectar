<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Tag::create(factory(App\Tag::class)->make()->toArray())->save();
        App\Tag::create(factory(App\Tag::class)->make()->toArray())->save();
        App\Tag::create(factory(App\Tag::class)->make()->toArray())->save();
        App\Tag::create(factory(App\Tag::class)->make()->toArray())->save();
        App\Tag::create(factory(App\Tag::class)->make()->toArray())->save();
        App\Tag::create(factory(App\Tag::class)->make()->toArray())->save();
    }
}
