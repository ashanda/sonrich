<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder

{

    /**

     * Run the database seeds.

     *

     * @return void

     */

    public function run()

    {

        $user = [

            [

                'name'=>'Super Admin',
 
                'email'=>'superadmin@superadmin.com',
 
                'role'=>'2',
 
                'password'=> bcrypt('123456'),
 
            ],

            [

               'name'=>'Admin',

               'email'=>'admin@admin.com',

               'role'=>'1',

               'password'=> bcrypt('123456'),

            ],

            [

               'name'=>'User',

               'email'=>'user@user.com',

                'role'=>'0',

               'password'=> bcrypt('123456'),

            ],

        ];

  

        foreach ($user as $key => $value) {

            User::create($value);

        }

    }

}
