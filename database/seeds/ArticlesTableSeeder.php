<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create();
		
		DB::table('roles')->insert([
			['name' => 'Member'],
			['name' => 'Admin'],
		]);
		
		/*
		DB::table('users')->insert([
			[
				'name' => 'kevin',
				'email' => 'kevin-dev@test.local',
				'password' => 'osef',
				'role_id' => 1,
			],
			[
				'name' => 'florent',
				'email' => 'florent-dev@test.local',
				'password' => 'osef',
				'role_id' => 1,
			],
			[
				'name' => 'olivier',
				'email' => 'olivier-dev@test.local',
				'password' => 'osef',
				'role_id' => 1,
			],
		]);
		
		DB::table('categories')->insert([
			[
				'title' => 'Laravel',
				'slug' => 'laravel',
				'description' => 'Quelques articles sur le framework Laravel',
				'user_id' => 1
			],
			[
				'title' => 'Symfony',
				'slug' => 'symfony',
				'description' => 'Quelques articles sur le framework Français Symfony',
				'user_id' => 1
			],
			[
				'title' => 'PHP',
				'slug' => 'php',
				'description' => 'Quelques astuces en PHP',
				'user_id' => 1
			],
			[
				'title' => 'ReactJS',
				'slug' => 'reactjs',
				'description' => 'Quelques articles sur la librairie ReactJS créée par Facebook',
				'user_id' => 1
			],
			[
				'title' => 'Selenium',
				'slug' => 'selenium',
				'description' => 'Tester c\'est important et parce qu\'il n\'y a pas que le développement qui compte',
				'user_id' => 1
			],
		]);
		
		for ($i = 1; $i <= 100; $i++) {
			$startingDate = $faker->dateTimeBetween('1 year ago', '+6 days');
			DB::table('articles')->insert([
				'published' => (bool) mt_rand(0, 1),
				'private' => (bool) mt_rand(0, 1),
				'title' => $faker->sentence($nbWords = 3, $variableNbWords = true) . ' ' .$i,
				'slug' => $faker->slug  . '-' .$i,
				'description' => $faker->text,
				'article' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
				'category_id' => mt_rand(1, 5),
				'displayed_at' => $startingDate,
				'user_id' => mt_rand(1, 3)
			]);
		}
		*/
    }
}
