<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users = factory(User::class)->times(50)->make();
      User::insert($users->toArray());

      $myuser = User::find(1);
      $myuser->name = 'Jay';
      $myuser->password = '123';
      $myuser->email = 'jayzhou215@163.com';
      $myuser->is_admin = true;
      $myuser->save();
    }
}
