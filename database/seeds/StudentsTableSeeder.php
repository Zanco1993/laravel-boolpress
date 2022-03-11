<?php

use Faker\Generator as Faker;

use App\Student;

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder {

/**

* Run the database seeds.

*

* @return void

*/

public function run(Faker $faker) {

for ($i = 0; $i < 100; $i++) {

$newStudent = new Student();
$newStudent-> name = $faker->name();
$newStudent->save();


}

}

}