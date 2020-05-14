<?php

use Illuminate\Database\Seeder;

class UsersSeddder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'=>'ghiath shamma',
            'email'=>'g@g.g',
            'password'=>bcrypt('12345678')
        ]);
    }
}
