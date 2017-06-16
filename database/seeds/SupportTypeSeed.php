<?php

use Illuminate\Database\Seeder;
use App\Models\SupportType;
class SupportTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('support_types')->delete();

        SupportType::create([
            'type'   => 'Finansial'
        ]);
        
        SupportType::create([
            'type'   => 'Non Finansial'
        ]);

    }
}
