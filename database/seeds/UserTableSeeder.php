<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create(factory(App\User::class)->make()->toArray())->save();
        App\User::create(factory(App\User::class)->make()->toArray())->save();
        App\User::create(factory(App\User::class)->make()->toArray())->save();
        App\User::create(factory(App\User::class)->make()->toArray())->save();
        App\User::create(factory(App\User::class)->make()->toArray())->save();
        App\User::create(factory(App\User::class)->make()->toArray())->save();
        App\User::create(factory(App\User::class)->make()->toArray())->save();
        App\User::create(factory(App\User::class)->make()->toArray())->save();
        App\User::create(factory(App\User::class)->make()->toArray())->save();
        App\User::create(factory(App\User::class)->make()->toArray())->save();
    }
}
