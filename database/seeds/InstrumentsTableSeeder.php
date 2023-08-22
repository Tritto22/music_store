<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Instrument;

class InstrumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0; $i<10; $i++){
            $newInstrument = new Instrument();
            $newInstrument->name = $faker->words(2, true);
            $newInstrument->code = $faker->numberBetween(1, 1000000);
            $newInstrument->slug = Str::of($newInstrument->name)->slug("-");
            $newInstrument->description = $faker->text();
            $newInstrument->price = $faker->randomFloat(2, 50, 10000);
            $newInstrument->left_handed_version = rand(0, 1);
            $newInstrument->available = rand(0, 1);
            $newInstrument->save();
        }
    }
}
