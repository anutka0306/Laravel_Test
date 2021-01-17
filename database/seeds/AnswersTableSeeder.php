<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert($this->getData());
    }

    private function getData():array {
        $faker = \Faker\Factory::create('ru-RU');
        $data = [];
        for($i = 1; $i<=4; $i++){
            for($j = 1; $j <= 3; $j++){
                $data[] = [
                    'question_id'=> $i,
                    'answer'=> $faker->sentence(rand(2,4)),
                    'point'=> $faker->numberBetween(0,10),
                ];
            }
        }
        return $data;
    }
}
