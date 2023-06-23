<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Presence;
use App\Models\Position;
use App\Models\Shift;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ]);
        User::create([
            'name' => 'Denis Aditya',
            'username' => 'denis',
            'password' => Hash::make('123'),
            'position' => 'Office'
        ]);
        User::factory(5)->create();

        Position::create([
            'position' => 'Office',
            'salary' => 200000
        ]);
        Position::create([
            'position' => 'Kitchen',
            'salary' => 100000
        ]);
        Position::create([
            'position' => 'Driver',
            'salary' => 80000
        ]);
        Position::create([
            'position' => 'Equipment',
            'salary' => 60000
        ]);

        Presence::create([
            'user_id' => 2,
            'work_date' => '2023-06-07',
            'time_in' => '08:55:09',
            'time_out' => '18:55:09',
            'work_time' => '10:00:00',
            'salary' => 200000,
            'bonus' => 20000
        ]);
        Presence::create([
            'user_id' => 2,
            'work_date' => '2023-04-13',
            'time_in' => '08:55:09',
            'time_out' => '18:55:09',
            'work_time' => '10:00:00',
            'salary' => 200000,
            'bonus' => 20000
        ]);
        Presence::create([
            'user_id' => 2,
            'work_date' => '2023-04-12',
            'time_in' => '08:55:09',
            'time_out' => '18:55:09',
            'work_time' => '10:00:00',
            'salary' => 200000,
            'bonus' => 20000
        ]);

        $i = 0;
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d');
        while ($i<=360) {
            $today = date('Y-m-d', strtotime("$i day", strtotime($weekStartDate)));
            Shift::create([
                'work_date' => $today
            ]);
            $i++;
        }
    }
}