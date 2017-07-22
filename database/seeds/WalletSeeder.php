<?php

use Illuminate\Database\Seeder;
use App\Models\Wallet;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('wallets')->delete();
      $users  = DB::table('users')->get();
      foreach($users as $user) {
          $wallet = Wallet::create(array(
            'total'         => 0,
            'user_id'				=> $user->id
          ));
      }
    }
}
