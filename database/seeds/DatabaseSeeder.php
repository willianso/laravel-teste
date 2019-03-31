<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'cpf'=> '91289182', 
            'name'=> 'www',
             'email'=> 'www@www',
              'password'=> bcrypt('123'),
              'phone'=> '5555',
              'birth'=> '1999-01-01',
              'gender'=> 'M',
        ]);
    }
}
