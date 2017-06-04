<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $adminRole = Role::whereName('administrator')->first();
        $orgRole = Role::whereName('organisasi')->first();
        $userRole = Role::whereName('user')->first();

        $user = User::create(array(
            'name'    			=> 'Pandhu Admin',
            'email'         => 'weniindya@gmail.com',
            'password'      => Hash::make('pandhuweni'),
            'token'         => str_random(64),
            'activated'     => true
        ));
        $user->assignRole($adminRole);

        $user = User::create(array(
            'name'    			=> 'Pandhu Weni',
            'email'         => 'pandhu.weni@gmail.com',
            'password'      => Hash::make('password'),
            'token'         => str_random(64),
            'activated'     => true
        ));
        $user->assignRole($userRole);

        $user = User::create(array(
            'name'    			=> 'Universitas Gadjah Mada',
            'email'         => 'ibumariyah24@gmail.com',
            'password'      => Hash::make('password'),
            'token'         => str_random(64),
            'activated'     => true
        ));
        $user->assignRole($orgRole);
    }
}
