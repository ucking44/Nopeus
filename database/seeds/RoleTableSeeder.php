<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role();
        $role_user->username = 'User';
        $role_user->description = 'A normal User';
        $role_user->save();

        $role_author = new Role();
        $role_author->username = 'Author';
        $role_author->description = 'A normal Author';
        $role_author->save();

        $role_admin = new Role();
        $role_admin->username = 'Admin';
        $role_admin->description = 'A normal Admin';
        $role_admin->save();
    }
}
