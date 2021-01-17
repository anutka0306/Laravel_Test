<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tests')->insert($this->getData());
    }

    private function getData():array{
        $faker = Faker\Factory::create('ru_RU');
        $data = [];
        for($i = 0; $i <= 4; $i++){
            $data[]=[
                'name'=>$faker->word(),
                'description'=>$faker->sentence(rand(10,20)),
                'cat'=>$faker->numberBetween(1,5),
                'min_pass_point'=>$faker->numberBetween(10,100),
                'is_deleted'=>0,
            ];
        }
        return $data;
    }
}
