<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password'=>'1234'
        ]);

        $this->call(StudentSeeder::class);
        $classes = [
            ['class_name' => 'class_A'],
            ['class_name' => 'class_B'],
            ['class_name' => 'class_C'],
            ['class_name' => 'class_D'],
        ];

        DB::table('table_class_item')->insert($classes);
    }
}
