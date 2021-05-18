<?php

namespace Database\Seeders;


use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CallbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('callback')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10) . '@gmail.com',
            'content' => 'I like it',
        ]);
    }
}
