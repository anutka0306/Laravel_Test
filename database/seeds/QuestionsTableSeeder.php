<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert($this->getData());
    }

    private function getData():array {
        $faker = \Faker\Factory::create('ru-RU');
        $data = [];
        for ($i = 0; $i < 4; $i++){
            $data[] = [
                'test_id'=>1,
                'question'=>$faker->sentence(rand(2,5)),
            ];
        }
        return $data;
    }
}
