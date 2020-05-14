<?php

use Illuminate\Database\Seeder;

class ChannelsSeddder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Channels::create([
            'title'=>'Laravel 6'
        ]);
        \App\Channels::create([
            'title'=>'Vue.js'
        ]);
        \App\Channels::create([
            'title'=>'React.js'
        ]);
        \App\Channels::create([
            'title'=>'Python'
        ]);
        \App\Channels::create([
            'title'=>'Php'
        ]);
    }
}
