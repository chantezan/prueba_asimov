<?php

use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Schedule::class)->create([
          'day' => 1,
      ]);
      factory(App\Schedule::class)->create([
          'day' => 2,
      ]);
      factory(App\Schedule::class)->create([
          'day' => 3,
      ]);
      factory(App\Schedule::class)->create([
          'day' => 4,
      ]);
      factory(App\Schedule::class)->create([
          'day' => 5,
      ]);

      factory(App\Book::class)->create();
    }
}
