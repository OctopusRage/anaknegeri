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

      $wallet = Wallet::create(array(
          'total'         => 0,
          'user_id'				=> 1
      ));

      $wallet = Wallet::create(array(
          'total'          => 0,
          'user_id'				=> 2
      ));

      $wallet = Wallet::create(array(
          'total'          => 0,
          'user_id'				=> 3
      ));

      $wallet = Wallet::create(array(
          'total'          => 0,
          'user_id'				=> 4
      ));

      $wallet = Wallet::create(array(
          'total'          => 0,
          'user_id'				=> 5
      ));

    }
}
